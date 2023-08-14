#!/bin/bash

# Definindo variáveis para conexão com o banco de dados
db_username="root"
db_password="admin"
db_name="teste"
table_name="Rules"

# Executando consulta SQL para obter as regras da tabela "Rules"
query_result=$(mysql -u "$db_username" -p"$db_password" -D "$db_name" -e "SELECT * FROM $table_name;")

# Limpando regras existentes no iptables
iptables -F

# Iterando sobre cada linha no resultado da consulta
while IFS=$'\t' read -r id rule_type source_ip source_port dest_ip dest_port protocol action; do
    # Verificando se todos os campos estão preenchidos
    if [[ -n "$id" && -n "$rule_type" && -n "$source_ip" && -n "$source_port" && -n "$dest_ip" && -n "$dest_port" && -n "$protocol" && -n "$action" ]]; then
        # Inicializando variáveis para opções de IP, porta e protocolo
        source_ip_option=""
        source_port_option=""
        dest_ip_option=""
        dest_port_option=""
        protocol_option=""

        # Construindo opções de IP de origem, se disponível
        if [ "$source_ip" != "NULL" ]; then
            source_ip_option="-s $source_ip"
        fi

        # Construindo opções de porta de origem, se disponível
        if [ "$source_port" != "NULL" ]; then
            source_port_option="--sport $source_port"
        fi

        # Construindo opções de IP de destino, se disponível
        if [ "$dest_ip" != "NULL" ]; then
            dest_ip_option="-d $dest_ip"
        fi

        # Construindo opções de porta de destino, se disponível
        if [ "$dest_port" != "NULL" ]; then
            dest_port_option="--dport $dest_port"
        fi

        # Construindo opção de protocolo, se disponível
        if [ "$protocol" != "NULL" ]; then
            protocol_option="-p $protocol"
        fi

        # Avaliando ação e adicionando regra correspondente ao iptables
        case "$action" in
            "ACCEPT")
                iptables -A INPUT $protocol_option $source_ip_option $source_port_option $dest_ip_option $dest_port_option -j ACCEPT
                ;;
            "DROP")
                iptables -A INPUT $protocol_option $source_ip_option $source_port_option $dest_ip_option $dest_port_option -j DROP
                ;;
            *)
                echo "Unknown action: $action"
                ;;
        esac
    fi
done <<< "$query_result"  # Alimentando o loop com o resultado da consulta

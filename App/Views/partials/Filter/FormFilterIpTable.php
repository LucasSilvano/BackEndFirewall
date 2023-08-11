<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Adicionar Regra Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form action="/firewall/addruler" method="post">
          <div class="mb-3">
            <label for="inputRuleType" class="form-label">Tipo de Regra</label>
            <select class="form-select" id="inputRuleType" name="rule_type" required>
              <option value="" disabled selected>Selecione o Tipo de Regra</option>
              <option>INPUT</option>
              <option>OUTPUT</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="inputSourceIP" class="form-label">IP de Origem</label>
            <input type="text" class="form-control" id="inputSourceIP" name="source_ip">
          </div>
          <div class="mb-3">
            <label for="inputSourcePort" class="form-label">Porta de Origem</label>
            <input type="number" class="form-control" id="inputSourcePort" name="source_port">
          </div>
          <div class="mb-3">
            <label for="inputDestIP" class="form-label">IP de Destino</label>
            <select class="form-select" id="inputDestIP" name="dest_ip">
              <option value="" disabled selected>IP de Destino</option>
              <option>100.64.145.183</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="inputDestPort" class="form-label">Porta de Destino</label>
            <input type="number" class="form-control" id="inputDestPort" name="dest_port">
          </div>
          <div class="mb-3">
            <label for="inputProtocol" class="form-label">Protocolo</label>
            <select class="form-select" id="inputProtocol" name="protocol">
              <option value="" disabled selected>Protocolo</option>
              <option>TCP</option>
              <option>UDP</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="inputAction" class="form-label">Ação</label>
            <select class="form-select" id="inputAction" name="action" required>
              <option value="" disabled selected>Selecione a Ação</option>
              <option>ACCEPT</option>
              <option>DROP</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
      </div>
    </div>
  </div>
</div>

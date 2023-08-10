CREATE DATABASE IpTables;

USE IpTables;

CREATE TABLE FirewallFilter(
    id INT PRIMARY KEY AUTO_INCREMENT,
    table_name VARCHAR(255) NOT NULL,
    chain VARCHAR(255) NOT NULL,
    protocol VARCHAR(50),
    port INT,
    ipAddress VARCHAR(50),
    state VARCHAR(50),
    action VARCHAR(50)
); 

CREATE TABLE FirewallNAT ();

CREATE TABLE FirewallMangle();
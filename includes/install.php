<?php
        // Informações da base de dados
        include 'config.php';

        //-------------------------------------------------------------------------------
        // Criar a base de dados
        //-------------------------------------------------------------------------------
        
        $pdo_bd = new PDO("mysql:host=$host", $utilizadorbd, $passbd);
        $motor = $pdo_bd->prepare("CREATE DATABASE $base_dados");
        $motor->execute();
        
        

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Abrir a base de dados
        //-------------------------------------------------------------------------------
        $pdo = new PDO("mysql:dbname=$base_dados;host=$host", "$utilizadorbd", "$passbd");

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "atendimentos"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `atendimentos` (
                        `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                        `descricao` varchar(60) NOT NULL,
                        `valor` decimal(10,2) NOT NULL
        );
        
        ";


        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "cargos"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `cargos` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(35) NOT NULL
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "especialidades"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `especialidades` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(30) NOT NULL
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "remedios"
        //-------------------------------------------------------------------------------

        $sql = "

        CREATE TABLE `remedios` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(50) NOT NULL,
                `descricao` varchar(50) NOT NULL,
                `estoque` int(11) NOT NULL DEFAULT 0
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "pacientes"
        //-------------------------------------------------------------------------------

        $sql = "

        CREATE TABLE `pacientes` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(35) NOT NULL,
                `nif` varchar(20) NOT NULL,
                `cc` varchar(20) DEFAULT NULL,
                `telefone` varchar(15) NOT NULL,
                `email` varchar(35) NOT NULL,
                `data_nascimento` date NOT NULL,
                `idade` int(11) NOT NULL,
                `estado_civil` varchar(15) DEFAULT NULL,
                `sexo` varchar(15) DEFAULT NULL,
                `endereco` varchar(100) DEFAULT NULL,
                `password` varchar(125) DEFAULT NULL,
                `obs` varchar(350) DEFAULT NULL
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();
        

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "utilizadores"
        //-------------------------------------------------------------------------------

        $sql = "

        CREATE TABLE `utilizadores` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(30) NOT NULL,
                `email` varchar(40) NOT NULL,
                `nif` varchar(20) NOT NULL,
                `telefone` varchar(20) NOT NULL,
                `cedula` varchar(20) DEFAULT NULL,
                `especialidade` int(11) DEFAULT NULL,
                `turno` varchar(15) DEFAULT NULL,
                `password` varchar(200) NOT NULL,
                `nivel` varchar(25) NOT NULL,
                `foto` varchar(150) DEFAULT NULL,
                `estado_conta` varchar(15) NOT NULL,

                FOREIGN KEY (`especialidade`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "funcionarios"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `funcionarios` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(35) NOT NULL,
                `nif` varchar(20) NOT NULL,
                `telefone` varchar(20) NOT NULL,
                `email` varchar(30) NOT NULL,
                `cargo` int(11) DEFAULT NULL,

                FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "fornecedores"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `fornecedores` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `nome` varchar(50) NOT NULL,
                `nif` varchar(20) NOT NULL,
                `email` varchar(35) NOT NULL,
                `telefone` varchar(35) NOT NULL,
                `remedios` int(11) NOT NULL,

                FOREIGN KEY (`remedios`) REFERENCES `remedios` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "consultas"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `consultas` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `data` date NOT NULL,
                `hora` time NOT NULL,
                `paciente` int(11) DEFAULT NULL,
                `tipo_atendimento` int(11) DEFAULT NULL,
                `medico` int(11) DEFAULT NULL,
                `valor` decimal(10,2) NOT NULL,
                `estado_pagamento` varchar(15) DEFAULT NULL,
                
                FOREIGN KEY (`medico`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`tipo_atendimento`) REFERENCES `atendimentos` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "contas_pagar"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `contas_pagar` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `descricao` varchar(40) NOT NULL,
                `valor` decimal(10,2) NOT NULL,
                `vencimento` date NOT NULL,
                `pagamento` date DEFAULT NULL,
                `pago` varchar(5) NOT NULL,
                `funcionario` int(11) DEFAULT NULL,
                `foto` varchar(150) DEFAULT NULL,
                
                FOREIGN KEY (`funcionario`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "pagamentos"
        //-------------------------------------------------------------------------------

        $sql = "

        CREATE TABLE `pagamentos` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `funcionario` int(11) DEFAULT NULL,
                `valor` decimal(10,2) NOT NULL,
                `tesoureiro` int(11) DEFAULT NULL,
                `data` date NOT NULL,

                FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`funcionario`) REFERENCES `funcionarios` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
        );


        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "contas_receber"
        //-------------------------------------------------------------------------------
        $sql = "
        
        CREATE TABLE `contas_receber` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `descricao` int(11) DEFAULT NULL,
                `valor` decimal(10,2) NOT NULL,
                `vencimento` date NOT NULL,
                `data_baixa` date DEFAULT NULL,
                `forma_pagamento` varchar(25) DEFAULT NULL,
                `tipo_pagamento` varchar(30) DEFAULT NULL,
                `tesoureiro` int(11) DEFAULT NULL,
                `id_consulta` int(11) DEFAULT NULL,

                FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`id_consulta`) REFERENCES `consultas` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`descricao`) REFERENCES `atendimentos` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();

        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "entradas_remedios"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `entradas_remedios` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `remedio` int(11) NOT NULL,
                `quantidade` int(11) NOT NULL,
                `valor` decimal(10,2) NOT NULL,
                `fornecedor` int(11) NOT NULL,
                `farmaceutico` int(11) NOT NULL,
                `data` date NOT NULL,

                FOREIGN KEY (`fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`farmaceutico`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`remedio`) REFERENCES `remedios` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();


        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "entradas_remedios"
        //-------------------------------------------------------------------------------
        $sql = "

        CREATE TABLE `saidas_remedios` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `remedio` int(11) NOT NULL,
                `quantidade` int(11) NOT NULL,
                `farmaceutico` int(11) NOT NULL,
                `data` date NOT NULL,

                FOREIGN KEY (`remedio`) REFERENCES `remedios` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`farmaceutico`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
        );

        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();


        //-------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------
        // Tabela "movimentacoes"
        //-------------------------------------------------------------------------------

        $sql = "

        CREATE TABLE `movimentacoes` (
                `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                `tipo` varchar(15) NOT NULL,
                `movimento` varchar(30) NOT NULL,
                `valor` decimal(10,2) NOT NULL,
                `tesoureiro` int(11) DEFAULT NULL,
                `data` date NOT NULL,
                `id_receber` int(11) DEFAULT NULL,
                `id_pagar` int(11) DEFAULT NULL,
                `id_pagamentos` int(11) DEFAULT NULL,

                FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`id_receber`) REFERENCES `contas_receber` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`id_pagar`) REFERENCES `contas_pagar` (`id`) ON DELETE CASCADE,
                FOREIGN KEY (`id_pagamentos`) REFERENCES `pagamentos` (`id`) ON DELETE CASCADE
        );


        ";

        $motor = $pdo->prepare($sql);
        $motor->execute();


        //-------------------------------------------------------------------------------


        $pdo = null;

        include 'insert.php';
?>
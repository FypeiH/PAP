<?php
        // Informações da base de dados
include 'config.php';

        //-------------------------------------------------------------------------------
        // Abrir a base de dados
        //-------------------------------------------------------------------------------
$ligacao = new PDO ("mysql:dbname=$base_dados;host=$host", $utilizadorbd, $passbd);

        //-------------------------------------------------------------------------------
        // Inserir
        //-------------------------------------------------------------------------------
$sql = "

INSERT INTO `atendimentos` (`id`, `descricao`, `valor`) VALUES
(1, 'Cirurgia Plástica', '1500.00'),
(2, 'Consulta Pediatra', '80.00');

INSERT INTO `cargos` (`id`, `nome`) VALUES
(1, 'Médico'),
(2, 'Recepcionista'),
(3, 'Tesoureiro'),
(4, 'Administrador'),
(5, 'Faxineiro'),
(6, 'Farmacêutico');

INSERT INTO `especialidades` (`id`, `nome`) VALUES
(1, 'Pediatria'),
(2, 'Obstetrícia'),
(3, 'Medicina Familiar'),
(4, 'Cirurgia'),
(5, 'Cardiologia');

INSERT INTO `remedios` (`id`, `nome`, `descricao`, `estoque`) VALUES
(1, 'Aspirina', '25mg', 5),
(2, 'Pílula', '15mg', 0);

INSERT INTO `pacientes` (`id`, `nome`, `nif`, `cc`, `telefone`, `email`, `data_nascimento`, `idade`, `estado_civil`, `sexo`, `endereco`, `password`, `obs`) VALUES
(1, 'Paciente', '222.222.222', '2222', '(+546) 43563456', 'pacienteuti@gmail.com', '2002-02-22', 18, 'Solteiro', 'Masculino', 'fsdafsdf', '202cb962ac59075b964b07152d234b70', 'gsdfgsdg'),
(2, 'Ricardo', '235.345.345', '345345345', '(+345) 34534535', 'fgdfg@gmail.com', '2002-02-22', 18, 'Solteiro', 'Masculino', 'zxczz', '25f9e794323b453885f5181f1b624d0b', NULL),
(3, 'André', '234.426.353', '345346356', '(+454) 65435634', 'gdfgdg@gmail.com', '2000-11-01', 20, 'Solteiro', 'Masculino', 'RSDHUFSDJGLDQ', NULL, NULL);

INSERT INTO `utilizadores` (`id`, `nome`, `email`, `nif`, `telefone`, `cedula`, `especialidade`, `turno`, `password`, `nivel`, `foto`, `estado_conta`) VALUES
(1, 'HospSYSAdmin', 'hospsys@gmail.com', '000.000.000', '(+111) 111111111', NULL, NULL, NULL, '25d55ad283aa400af464c76d713c07ad', 'Admin', 'sem-foto.png', 'Ativo'),
(2, 'Recepcionista', 'recepcionista@gmail.com', '666.666.666', '(+666) 666666666', NULL, NULL, 'Tarde', '9f0863dd5f0256b0f586a7b523f8cfe8', 'Recepcionista', 'sem-foto.png', 'Ativo'),
(3, 'Tesoureiro', 'tesoureiro@gmail.com', '777.777.777', '(+777) 777777777', NULL, NULL, 'Manhã', 'ca94efe2a58c27168edf3d35102dbb6d', 'Tesoureiro', 'sem-foto.png', 'Ativo'),
(4, 'António', 'medico@gmail.com', '111.111.111', '(+111) 111111111', '000', 2, 'Tarde', 'bbb8aae57c104cda40c93843ad5e6db8', 'Médico', 'sem-foto.png', 'Ativo'),
(5, 'Paciente', 'pacienteuti@gmail.com', '222.222.222', '(+546) 435634564', NULL, NULL, NULL, '202cb962ac59075b964b07152d234b70', 'Paciente', 'sem-foto.png', 'Ativo'),
(6, 'Farmacêutico', 'farmaceutico@gmail.com', '333.333.333', '(+333) 333333333', NULL, NULL, 'Manhã', '77c9749b451ab8c713c48037ddfbb2c4', 'Farmacêutico', 'sem-foto.png', 'Ativo'),
(7, 'sdfsdfsdfg', 'fgdfg@gmail.com', '235.345.345', '(+345) 345345353', NULL, NULL, NULL, '25f9e794323b453885f5181f1b624d0b', 'Paciente', 'sem-foto.png', 'Ativo'),
(8, 'João Mendes', 'joao@gmail.com', '345.363.755', '(+754) 675467457', '1234', 4, 'Tarde', '7667ed4464f5ddcccb4cc208057727dc', 'Médico', 'sem-foto.png', 'Ativo');

INSERT INTO `funcionarios` (`id`, `nome`, `nif`, `telefone`, `email`, `cargo`) VALUES
(1, 'Filipe Bravo', '000.000.000', '(+111) 111111111', 'pippo.a.bravo@gmail.com', 4),
(2, 'Maria Jesus', '234.365.675', '(+345) 645747456', 'maria@gmail.com', 5),
(3, 'Recepcionista', '666.666.666', '(+666) 666666666', 'recepcionista@gmail.com', 2),
(4, 'Tesoureiro', '777.777.777', '(+777) 777777777', 'tesoureiro@gmail.com', 3),
(5, 'António', '111.111.111', '(+111) 111111111', 'medico@gmail.com', 1),
(6, 'Farmacêutico', '333.333.333', '(+333) 333333333', 'farmaceutico@gmail.com', 6),
(7, 'João Mendes', '345.363.755', '(+754) 675467457', 'joao@gmail.com', 1);

INSERT INTO `fornecedores` (`id`, `nome`, `nif`, `email`, `telefone`, `remedios`) VALUES
(1, 'Fornecedor', '634.567.564', 'fornecedor@gmail.com', '(+643) 574568745', 1);

INSERT INTO `consultas` (`id`, `data`, `hora`, `paciente`, `tipo_atendimento`, `medico`, `valor`, `estado_pagamento`) VALUES
(1, '2020-11-29', '11:30:00', 1, 1, 4, '1500.00', 'Não'),
(2, '2020-11-29', '08:30:00', 1, 1, 4, '1500.00', 'Não'),
(3, '2020-11-29', '18:00:00', 2, 1, 4, '1500.00', 'Não'),
(4, '2020-12-03', '18:00:00', 3, 2, 4, '80.00', 'Não');


INSERT INTO `contas_pagar` (`id`, `descricao`, `valor`, `vencimento`, `pagamento`, `pago`, `funcionario`, `foto`) VALUES
(1, 'Compra do/a Aspirina', '25.00', '2020-11-24', '2020-11-24', 'Sim', 4, 'sem-foto.png');

INSERT INTO `pagamentos` (`id`, `funcionario`, `valor`, `tesoureiro`, `data`) VALUES
(1, 2, '12345.00', 4, '2020-11-29');

INSERT INTO `contas_receber` (`id`, `descricao`, `valor`, `vencimento`, `data_baixa`, `forma_pagamento`, `tipo_pagamento`, `tesoureiro`, `id_consulta`) VALUES
(1, 1, '1500.00', '2020-11-29', NULL, NULL, NULL, NULL, 1),
(2, 1, '1500.00', '2020-11-29', NULL, NULL, NULL, NULL, 2),
(3, 1, '1500.00', '2020-11-29', NULL, NULL, NULL, NULL, 3),
(4, 2, '80.00', '2020-12-03', NULL, NULL, NULL, NULL, 4);

INSERT INTO `entradas_remedios` (`id`, `remedio`, `quantidade`, `valor`, `fornecedor`, `farmaceutico`, `data`) VALUES
(1, 1, 5, '5.00', 1, 6, '2020-11-24');

INSERT INTO `movimentacoes` (`id`, `tipo`, `movimento`, `valor`, `tesoureiro`, `data`, `id_receber`, `id_pagar`, `id_pagamentos`) VALUES
(1, 'Saída', 'Compra do/a Aspirina', '25.00', 3, '2020-11-24', NULL, 1, NULL),
(2, 'Saída', 'Salário dos Funcionários', '12345.00', 3, '2020-11-29', NULL, NULL, 1);



";

$motor = $ligacao->prepare($sql);
$motor->execute();

        //-------------------------------------------------------------------------------

$ligacao = null;
?>
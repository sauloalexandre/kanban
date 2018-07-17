CREATE DATABASE IF NOT EXISTS kanban;
USE kanban;


CREATE TABLE IF NOT EXISTS `tarefas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prioridade` int(11) NOT NULL,
  `onde` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `detalhes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;


INSERT INTO `tarefas` (`id`, `prioridade`, `onde`, `titulo`, `detalhes`) VALUES
	(1, 0, 'done', 'tarefa 1', ''),
	(53, 1, 'test', 'tarefa 2', ''),
	(55, 1, 'inProgress', 'tarefa 4', 'detalhes tarefa 4'),
	(56, 1, 'todo', 'tarefa 3', ''),
	(57, 2, 'inProgress', 'tarefa 5', ''),
	(58, 2, 'test', 'tarefa 6', ''),
	(59, 0, 'todo', 'tarefa 7', 'teste tarefas'),
	(60, 0, 'test', 'tarefa 8', 'detalhes tarefa 8'),
	(61, 0, 'inProgress', 'tarefa 8', '');

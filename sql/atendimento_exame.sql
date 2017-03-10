ALTER TABLE `labvet`.`atendimento_exame` 
ADD COLUMN `laudo` INT(5) NULL AFTER `ativo`;

/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `labvet`.`atendimento_exame_BEFORE_INSERT` BEFORE INSERT ON `atendimento_exame` FOR EACH ROW
BEGIN

	DECLARE cod int;

	SELECT max(ifnull(laudo,0)) + 1 INTO cod FROM atendimento_exame WHERE year(cadastro) = year(new.cadastro);

	set NEW.laudo = cod;

END */;;
DELIMITER ;
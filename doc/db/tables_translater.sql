-- t_language ------------------------------------------------------
DROP TABLE IF EXISTS `t_language`;

CREATE TABLE IF NOT EXISTS `t_language` (
  `langID` bigint(5) unsigned NOT NULL AUTO_INCREMENT,
  `langName` varchar(50) NOT NULL,
  PRIMARY KEY (`langID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

TRUNCATE TABLE `t_language`;

INSERT INTO `t_language` (`langID`, `langName`) VALUES
(1, 'Russian'),
(2, 'English'),
(3, 'German'),
(4, 'French'),
(5, 'Italian'),
(6, 'Spanish'),
(7, 'Polish');



-- t_wordsbase ------------------------------------------------------
DROP TABLE IF EXISTS `t_wordsbase`;

CREATE TABLE IF NOT EXISTS `t_wordsbase` (
  `wbID` bigint(5) unsigned NOT NULL AUTO_INCREMENT,
  `wbContent` varchar(256) NOT NULL,
  `wbEqual` bigint(5) NOT NULL,
  `wbLangID` bigint(5) NOT NULL,
  PRIMARY KEY (`wbID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

TRUNCATE TABLE `t_wordsbase`;

INSERT INTO `t_wordsbase` (`wbID`, `wbContent`, `wbEqual`, `wbLangID`) VALUES
(1, 'яблоко', 1, 1),
(2, 'apple', 1, 2),
(3, 'Apfel', 1, 3),
(4, 'pomme', 1, 4),
(5, 'mela', 1, 5),
(6, 'manzana', 1, 6),
(7, 'jabłko', 1, 7),

(8, 'табак', 2, 1),
(9, 'tobacco', 2, 2),
(10, 'Tabak', 2, 3),
(11, 'le tabac', 2, 4),
(12, 'tobaco', 2, 5),
(13, 'tabacco', 2, 6),
(14, 'tytoń', 2, 7),

(15, 'кальян', 3, 1),
(16, 'hookah', 3, 2),
(17, 'Huka', 3, 3),
(18, 'narguilé', 3, 4),
(19, 'narghilè', 3, 5),
(20, 'narguile', 3, 6),
(21, 'nargile', 3, 7),

(22, 'стол', 4, 1),
(23, 'table', 4, 2),
(24, 'Tabelle', 4, 3),
(25, 'table', 4, 4),
(26, 'tavolo', 4, 5),
(27, 'mesa', 4, 6),
(28, 'stół', 4, 7);



-- t_text ------------------------------------------------------
DROP TABLE IF EXISTS `t_text`;

CREATE TABLE IF NOT EXISTS `t_text` (
  `textID` bigint(5) unsigned NOT NULL AUTO_INCREMENT,
  `textContent` varchar(65535) NOT NULL,
  PRIMARY KEY (`textID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

TRUNCATE TABLE `t_text`;

INSERT INTO `t_text` (`textID`, `textContent`) VALUES
(1, "		  
		 <h2>Какие бывают виды табака?</h2>
		  
		  <p>&nbsp;</p>
		  <h4 class='text-intro'>
			<p><strong>Табак можно разделить на два вида:</strong></p>
			<ul>
				<li>с ароматом</li>
				<li>без запаха, с естественным вкусом</li>
			</ul>			
		  </h4>
		  
		  <div class='text-block'>
			  <p>
				<strong>Табак без искусственного аромата</strong> зачастую используют в тех странах, где курение кальяна является популярным занятием. Его смешивают с различными травами, сухими ягодами и фруктами.
			  </p>
			  
			  <p>&nbsp;</p>	  
			  <p>
				<strong>Ароматизированный</strong> табак имеет ярко-выраженный запах и специфическую влажную консистенцию. Производители используют различные вкусы, дабы удовлетворить потребности максимального количества потребителей. На сегодняшний день существует более 80 вкусов табака для кальяна. Благодаря широкому ассортименту запахов каждый может наслаждаться необычным дымом – со вкусом фруктов, ягод, сладостей, коктейлей и даже пряностей.
				<br>
				Приобретая табак, уже не нужно волноваться о том, как приготовить вкусный и оригинальный кальян, остается лишь сделать свой выбор среди представленного ассортимента. 
			  </p>
		  </div>
		  
		  <p>&nbsp;</p>
		  <!--<button class='btn btn-default btn-lg'>Изменить текст</button>-->
");
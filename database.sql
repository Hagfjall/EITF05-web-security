CREATE TABLE `users` (
 `email` varchar(400) NOT NULL,
 `name` varchar(400) NOT NULL,
 `password` char(128) NOT NULL,
 `salt` binary(16) NOT NULL,
 `address` varchar(300) NOT NULL,
 PRIMARY KEY (`email`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

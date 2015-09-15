CREATE TABLE `users` (
 `email` varchar(400) NOT NULL,
 `name` varchar(400) NOT NULL,
 `password` binary(64) NOT NULL,
 `salt` char(24) NOT NULL,
 PRIMARY KEY (`email`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

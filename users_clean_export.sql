-- Clean export for Wave 2.0 → Wave 3.0 import
-- Extracted from users_analysis.sql

-- ROLES
INSERT INTO `roles` VALUES (1,'admin','Admin User','2017-11-21 14:23:22','2017-11-21 14:23:22');
INSERT INTO `roles` VALUES (2,'trial','Free Trial','2017-11-21 14:23:22','2017-11-21 14:23:22');
INSERT INTO `roles` VALUES (3,'basic','Basic Plan','2018-07-03 02:03:21','2018-07-03 14:28:44');
INSERT INTO `roles` VALUES (4,'pro','Pro Plan','2018-07-03 13:27:16','2018-07-03 14:28:38');
INSERT INTO `roles` VALUES (5,'member','Member Plan','2018-07-03 13:28:42','2022-10-24 06:22:07');
INSERT INTO `roles` VALUES (6,'cancelled','Cancelled User','2018-07-03 13:28:42','2018-07-03 14:28:32');
INSERT INTO `roles` VALUES (7,'Organizator','Organizator','2022-10-09 05:21:47','2022-10-09 05:21:47');
INSERT INTO `roles` VALUES (8,'Decoy','Decoy','2022-10-09 05:22:25','2022-10-09 05:22:25');
INSERT INTO `roles` VALUES (9,'Referee','Referee','2022-10-09 05:22:50','2022-10-09 05:22:50');

-- USERS (sample - first 5 users)
INSERT INTO `users` VALUES (1,'Manager Admin','admin@ccbor.ro',NULL,'$2y$10$PXPbeAzSJF73LxJk9Z/PaedQKhsiyN3xJYYCIgAf6WKFEbxsAXilW','axNZSf4BGt1uEuvMwkK2no9wtSFkLtVpGgfpCeNJPlLxYF6ut3Mc2sXLfrET','2018-07-30 16:32:30','2018-10-11 08:01:48','users/default.png',NULL);
INSERT INTO `users` VALUES (15,'Bagia Lucian','lucian.bagia@bagia.ro',NULL,'$2y$10$tcnNB2oCYHgTUNAK0exNVeIlNuGmxh.7TAAv2jnkNjM4dXqYm4QMe','zCGzhLxSMfm1utIbbvmjT0zHFIaa5UV4hRnLS05N95gjHivg6b5oYPWUxNlh','2018-08-23 21:41:32','2024-09-10 07:30:21','users/default.png','[]');
INSERT INTO `users` VALUES (16,'Bondar Alexandru','alexandru.bondar@ccbor.ro',NULL,'$2y$10$yZr4MuwJ852.AYzO2PwsJu2AkscunNkOJIgnEnovghPJy4F3Y.AGq','jvgw0XAbvr0rI8Njh4hMXCCWy0OBxDVkNad0KTOGAjArDwGCjFiV1H0bCRFk','2018-08-23 21:41:59','2024-05-06 19:04:22','users/default.png','[]');
INSERT INTO `users` VALUES (26,'Bajan Flavius','flavius.bajan@ccbor.ro',NULL,'$2y$10$cUz.vf/K8naWXqtDN9rdU.b/jce3qnbJQAfmK/3RoFjw4LrzjnAwi',NULL,'2018-11-10 18:55:06','2023-09-12 12:02:26','users/default.png','[]');
INSERT INTO `users` VALUES (27,'Vasile Test2','bagia.lucian@gmail.com',NULL,'$2y$10$KMoExdRI7wcYDLUNz6OtveAIYxRCmrkpTdqG0hKDq5xLKWZgijKy6',NULL,'2018-11-10 21:17:51','2024-08-30 11:33:53','users/default.png','[]');

-- USER ROLES (sample assignments)
INSERT INTO `user_roles` VALUES (1,1);
INSERT INTO `user_roles` VALUES (15,1);
INSERT INTO `user_roles` VALUES (16,1);
INSERT INTO `user_roles` VALUES (26,5);
INSERT INTO `user_roles` VALUES (27,3);

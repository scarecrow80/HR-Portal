CREATE DEFINER=`db_hr_portal` EVENT `Schedule delete checklist`
ON SCHEDULE EVERY 1 MONTH STARTS '2018-05-05 16:20:00'
ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Testing if delete'
DO DELETE FROM `newemployee_has_checklist` WHERE `Newemployee_idNewemployee`
IN (SELECT `idNewemployee` FROM `newemployee` WHERE `startdate` < DATE_SUB(NOW(), INTERVAL 1 YEAR))

CREATE DEFINER=`db_hr_portal` EVENT `Schedule delete mentor`
ON SCHEDULE EVERY 1 MONTH STARTS '2018-05-05 16:20:00'
ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Testing if delete'
DO DELETE FROM `users_has_newemployee` WHERE `Newemployee_idNewemployee`
IN (SELECT `idNewemployee` FROM `newemployee` WHERE `startdate` < DATE_SUB(NOW(), INTERVAL 1 YEAR))

CREATE DEFINER=`db_hr_portal` EVENT `Schedule delete newemployee`
ON SCHEDULE EVERY 1 MONTH STARTS '2018-05-05 16:20:30'
ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Testing if delete'
DO DELETE FROM `newemployee` WHERE `startdate` < DATE_SUB(NOW(), INTERVAL 1 YEAR)
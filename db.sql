use test;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS comp;
CREATE TABLE comp (
 cid TINYINT   NOT NULL    AUTO_INCREMENT    PRIMARY KEY,
 company_name               VARCHAR(25),
 company_address            VARCHAR(30),
 company_phone              VARCHAR(12)
);

DROP TABLE IF EXISTS emp;
CREATE TABLE emp (
 eid TINYINT   NOT NULL     AUTO_INCREMENT    PRIMARY KEY,
 cidfk TINYINT NOT NULL,
 fullname                   VARCHAR(25),
 email1                     VARCHAR(30),
 email2                     VARCHAR(30),
 job_title                  VARCHAR(30),
 salary                     MEDIUMINT,
 start_date                 DATE
-- FOREIGN KEY (cidfk) REFERENCES company_info (cid)
);

DROP TABLE IF EXISTS user; 
CREATE TABLE user (
 uid   TINYINT   NOT NULL   AUTO_INCREMENT    PRIMARY KEY,
 eidfk TINYINT   NOT NULL,
 username                   VARCHAR(25),
 password                   BINARY(32) NOT NULL,
 permission_level           VARCHAR(10),
 is_permission_level_active BOOL
-- FOREIGN KEY (eidfk) REFERENCES employee(eid)
);

ALTER TABLE emp  ADD FOREIGN KEY (cidfk) references comp(cid);
ALTER TABLE user ADD FOREIGN KEY (eidfk) references emp(eid);

SET foreign_key_checks = 1;

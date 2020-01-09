-- CREATE DATATBASE

CREATE DATABASE lithathampandatabase;

-- CREATE USER AND GRANT PERMISSIONS

CREATE USER 'lithathampan'@'%' IDENTIFIED BY 'lithathampanpass';

GRANT SELECT, INSERT, DELETE,EXECUTE, UPDATE ON lithathampandatabase.* TO lithathampan@'%';

-- DDL

DROP TABLE IF EXISTS `lithathampandatabase`.`booking`;
DROP TABLE IF EXISTS `lithathampandatabase`.`roomtype`;
create table `lithathampandatabase`.`roomtype`
(
  roomtypeid int  not null AUTO_INCREMENT,
  listprice numeric(8,2) not null,
  features varchar(1000) not null,
  roomtypename varchar(50) not null,
  roomcount int not null,
  `roomimage` VARCHAR(100),
  primary key (roomtypeid)
);

create table `lithathampandatabase`.`booking`
(
  bookingid int not null AUTO_INCREMENT,
  startdate date not null,
  enddate date not null,
  comments varchar(1000) not null,
  adultcount int not null,
  childcount int not null,
  customername varchar(100) not null,
  customeraddress varchar(1000) not null,
  customerphone varchar(20) not null,
  customeremail varchar(100) not null,
  numberofrooms int not null,
  roomtypeid int not null,
  primary key (bookingid),
  foreign key (roomtypeid) references roomtype(roomtypeid)
);

-- DML (RoomTypes)

INSERT INTO `lithathampandatabase`.`roomtype` (`listprice`, `features`, `roomtypename`, `roomcount`,`roomimage`) VALUES ('50.00', 'Wifi, TV ', 'Bronze', '25','bronze.jpg');
INSERT INTO `lithathampandatabase`.`roomtype` (`listprice`, `features`, `roomtypename`, `roomcount`,`roomimage`) VALUES ('100.00', 'Wifi, TV , Coffee Machine', 'Silver', '20','silver.jpg');
INSERT INTO `lithathampandatabase`.`roomtype` (`listprice`, `features`, `roomtypename`, `roomcount`,`roomimage`) VALUES ('150.00', 'Wifi , TV, Washer, Coffee Machine', 'Gold', '10','gold.jpg');
INSERT INTO `lithathampandatabase`.`roomtype` (`listprice`, `features`, `roomtypename`, `roomcount`,`roomimage`) VALUES ('200.00', 'Wifi , TV, Washer, Mini Kitchen', 'Platinum', '6','platinum.jpg');
INSERT INTO `lithathampandatabase`.`roomtype` (`listprice`, `features`, `roomtypename`, `roomcount`,`roomimage`) VALUES ('500.00', 'Wifi , TV, Washer,Coffee Machine, Mini Kitchen', 'Suite', '3','suite.jpg');


-- ROUTINES

-- get_roomdetails - Getting Room Details for Booking process

use lithathampandatabase;
DROP PROCEDURE IF EXISTS `sp_get_roomdetails`;
DELIMITER $$
CREATE DEFINER=`lithathampan`@`%` PROCEDURE `sp_get_roomdetails`(p_numofrooms int, p_startdate date, p_enddate date, p_roomtypeid int)
BEGIN

SELECT roomtype.roomtypeid,roomtype.roomtypename,roomtype.features,roomtype.listprice,roomtype.roomimage,
roomtype.roomcount-sum(case when booking.bookingid is null then 0 else booking.numberofrooms end) availablerooms,
roomtype.listprice * p_numofrooms * (datediff(p_enddate,p_startdate)) totalprice
from lithathampandatabase.roomtype
left join lithathampandatabase.booking on roomtype.roomtypeid = booking.roomtypeid
and not((booking.startdate >= p_enddate
	or 
	  booking.enddate <= p_startdate ))
where (roomtype.roomtypeid = p_roomtypeid or p_roomtypeid = -1)
group by roomtype.roomtypeid
having availablerooms > p_numofrooms;

END$$
DELIMITER ;

-- book_room - Makes entry to booking table

use lithathampandatabase;
DROP PROCEDURE IF EXISTS `sp_book_room`;
DELIMITER $$
    
CREATE DEFINER=`lithathampan`@`%` PROCEDURE `sp_book_room`(p_roomtypeid int, p_numofrooms int, p_startdate date, p_enddate date, 
p_comments varchar(1000),p_numadult int, p_numchild int, p_name varchar(100), p_address varchar(1000),p_phone varchar(20), p_custemail varchar(100))
BEGIN

DECLARE v_bookingid int;

INSERT INTO `lithathampandatabase`.`booking`
(`startdate`,`enddate`,`comments`,`adultcount`,`childcount`,`customername`,`customeraddress`,
`customerphone`,`customeremail`,`numberofrooms`,`roomtypeid`)
VALUES
(
p_startdate,p_enddate,p_comments,p_numadult,p_numchild,p_name,p_address,p_phone,p_custemail,p_numofrooms,p_roomtypeid);

SELECT last_insert_id() into v_bookingid;

SELECT v_bookingid;

END$$
DELIMITER ;

-- get_roomtypes - Getting Room Types for Managing Room Types

use lithathampandatabase;
DROP PROCEDURE IF EXISTS `sp_get_roomtypes`;
DELIMITER $$
CREATE DEFINER=`lithathampan`@`%` PROCEDURE `sp_get_roomtypes`(p_roomtypeid int)
BEGIN

SELECT roomtypeid,roomtypename,listprice,features,roomcount,roomimage 
FROM roomtype
where (roomtype.roomtypeid = p_roomtypeid or p_roomtypeid = -1);

END$$
DELIMITER ;

-- set_roomtypes - Updating Room Types for Managing Room Types

use lithathampandatabase;
DROP PROCEDURE IF EXISTS `sp_set_roomtype`;
DELIMITER $$
CREATE DEFINER=`lithathampan`@`%` PROCEDURE `sp_set_roomtype`(
    p_roomtypeid int,p_listprice numeric(8,2),p_features varchar(1000),p_roomtypename varchar(50),p_roomcount int,p_roomimage varchar(100))
BEGIN

UPDATE roomtype
SET listprice = p_listprice,
features = p_features,
roomtypename = p_roomtypename,
roomcount = p_roomcount,
roomimage = p_roomimage
where roomtype.roomtypeid = p_roomtypeid ;

END$$
DELIMITER ;


-- get_bookings - Get List of all current bookings


use lithathampandatabase;
DROP PROCEDURE IF EXISTS `sp_get_bookings`;
DELIMITER $$
CREATE DEFINER=`lithathampan`@`%` PROCEDURE `sp_get_bookings`(p_bookingid int)
BEGIN
SELECT `booking`.`bookingid`,
    `booking`.`startdate`,
    `booking`.`enddate`,
    `booking`.`comments`,
    `booking`.`adultcount`,
    `booking`.`childcount`,
    `booking`.`customername`,
    `booking`.`customeraddress`,
    `booking`.`customerphone`,
    `booking`.`customeremail`,
    `booking`.`numberofrooms`,
    `booking`.`roomtypeid`,
    `roomtype`.`roomtypename`
FROM `lithathampandatabase`.`booking`
inner join `lithathampandatabase`.`roomtype` on booking.roomtypeid = roomtype.roomtypeid
where (`booking`.`bookingid` = p_bookingid or p_bookingid = -1);

END$$
DELIMITER ;

-- cancel_booking - Cancel a current booking

use lithathampandatabase;
DROP PROCEDURE IF EXISTS `sp_cancel_booking`;
DELIMITER $$
CREATE DEFINER=`lithathampan`@`%` PROCEDURE `sp_cancel_booking`(p_bookingid int)
BEGIN

DELETE
FROM `lithathampandatabase`.`booking`
where `booking`.`bookingid` = p_bookingid ;

END$$
DELIMITER ;

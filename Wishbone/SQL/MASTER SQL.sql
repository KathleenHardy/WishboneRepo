drop table if exists bookedVenues;
drop table if exists bookedGigs;
drop table if exists bookingRequests;
drop table if exists venueVideos;
drop table if exists venues;
drop table if exists venuePendingBookings;
drop table if exists eventPlanners;
drop table if exists venueOwners;
drop table if exists entertainerAvailability;
drop table if exists venueAvailability;
drop table if exists entertainerVideos;
drop table if exists gigsImages;
drop table if exists gigs;
drop table if exists gigsPendingBookings;
drop table if exists entertainers; 
drop table if exists entertainerBookingNotifications; 
drop table if exists venueBookingNotifications; 
drop table if exists venueOwnerNotifications; 
drop view  if exists gigsDetails;
drop view  if exists occupation;


drop table if exists experience;
drop table if exists feeds;
drop table if exists artprofile;
drop table if exists artist_interest;
drop table if exists interests;
drop table if exists artist_artform;
drop table if exists artforms;
drop table if exists artists;
drop table if exists connected_friends;
drop table if exists messages;
drop table if exists contact;
drop table if exists address;
-- drop table if exists authentication;  -- Use this for old table take out the remark
drop table if exists users;
drop table if exists authentication; -- Remark this out for old table

/*
Table for Authentication - may later be moved so it is only table on server directly exposed
	- added usertype 
*/
CREATE TABLE authentication (
    authid int not null auto_increment,
    email varchar(50) unique,
    pass varchar(50),
    userType int not null,

    primary key (authid)
);

/*
User table - generic user for service - without gigs or artist connect functionality
*/
CREATE TABLE users (
    userid int not null auto_increment,
    authid int not null,
    firstname varchar(50),
    lastname varchar(50),
    imagelocation varchar(100),
    FOREIGN KEY (authid) REFERENCES authentication(authid),
    PRIMARY KEY (userid)
); 


/*
Address information of a user
*/
CREATE TABLE address (
    addressid int not null auto_increment,
    city varchar(50),
    province varchar(50),
    country varchar(50),
    userid int not null,
    publicaddress boolean,
    
    primary key (addressid),
    FOREIGN KEY (userid) REFERENCES users(userid)
);
/*
contact information
*/
CREATE TABLE contact (
contactid int not null auto_increment,
email varchar(50),
phonenumber varchar(25),
userid int,
publicemail boolean,
publicphone boolean,

primary key (contactid),
FOREIGN KEY (userid) REFERENCES users(userid)
);
/*
send text messages to other users
*/
Create Table messages(
messageid int not null auto_increment,
senderid int not null,
receiverid int not null,
messagecontent varchar(2000),
hasread boolean,
primary key (messageid),
FOREIGN KEY (senderid) REFERENCES users(userid),
FOREIGN KEY (receiverid) REFERENCES users(userid)
);
/*
link friends for mynetwork, and as contacts list for messages
*/
create table connected_friends(
leftid int not null, -- initiating user
rightid int not null, -- selected user
confirmright boolean, -- selected user must confirm
FOREIGN KEY (leftid) REFERENCES users(userid),
FOREIGN KEY (rightid) REFERENCES users(userid)

);
/*
Parent of artist social networking site
*/
create table artists(
artistid int not null auto_increment,
userid int not null,
primary key (artistid),
FOREIGN KEY (userid) REFERENCES users(userid)
);
/*
Types of artforms for artists
*/
create table artforms(
artformid int not null auto_increment,
formname varchar(50) unique,
primary key (artformid)
);
/*
link artists to artforms
*/
create table artist_artform(
artformid int not null,
artistid int not null,
FOREIGN KEY (artformid) REFERENCES artforms(artformid),
FOREIGN KEY (artistid) REFERENCES artists(artistid),
primary key (artformid,artistid)
);
/*
types of interests
*/
create table interests(
interestid int not null auto_increment,
interestname varchar(50) unique,
primary key (interestid)
);
/*
connect artists to interests
*/
create table artist_interest(
interestid int not null,
artistid int not null,
FOREIGN KEY (interestid) REFERENCES interests(interestid),
FOREIGN KEY (artistid) REFERENCES artists(artistid),
primary key (interestid,artistid)
);
/*
Artists visible profile data
*/
create table artprofile(
profileid int not null auto_increment,
artistid int not null,
text1 varchar(500),
text2 varchar(500),
text3 varchar(500),
text4 varchar(500),
 `socialid` varchar(25) DEFAULT NULL,
  `shareurl` varchar(50) DEFAULT "",
  `bio` varchar(200) NOT NULL DEFAULT "enter bio",
  `urldes` varchar(200) NOT NULL Default "enter description",
primary key (profileid),
FOREIGN KEY (artistid) REFERENCES artists(artistid)
);

CREATE TABLE `experience` (
  `experienceid` int(11) NOT NULL auto_increment,
  `experiencetitle` varchar(30) NOT NULL,
  `experiencedes` text NOT NULL,
  `experiencetime` varchar(20) NOT NULL,
  `profileid` int(11) NOT NULL,
  primary key (experienceid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experience`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
 
  ADD KEY `profileID` (`profileid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `experienceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experiencepk` FOREIGN KEY (`profileid`) REFERENCES `artprofile` (`profileid`);
  
  create table feeds(
userid int(11),
feedtext longtext, 
feeddate timestamp default current_timestamp);


CREATE VIEW User_Profile_view AS

SELECT users.lastname, users.firstname, users.userid, artprofile.text1, artprofile.text2, artprofile.text3, artprofile.text4,contact.email, contact.phonenumber,
address.city, address.province, address.country
FROM artists
    INNER JOIN artprofile
        ON artists.artistid = artprofile.artistid
    INNER JOIN users 
        ON artists.userid = users.userid
	INNER JOIN contact
        ON contact.userid = users.userid
    INNER JOIN address 
        ON address.userid = address.userid;
		
		
		
		
CREATE VIEW Public_User_Profile_view AS

SELECT DISTINCT users.userid, users.lastname, users.firstname, 

	CASE WHEN contact.publicemail = true 
			THEN contact.email 
	ELSE '' END AS email,
    
	CASE WHEN contact.publicphone = true 
			THEN contact.phonenumber 
	ELSE '' END AS phonenumber,
    
	CASE WHEN address.publicaddress = true 
			THEN address.city
	ELSE '' END AS city,
    
	CASE WHEN address.publicaddress = true 
			THEN address.province
	ELSE '' END AS province,
    
	CASE WHEN address.publicaddress = true 
			THEN address.country
	ELSE '' END AS country
     
    
FROM ((contact
    INNER JOIN users
        ON contact.userid = users.userid )
    INNER JOIN address 
        ON address.userid = address.userid);






CREATE VIEW message_view AS
SELECT  
u1.userid AS senderid,
u1.firstname AS sender_first_name,
u1.lastname AS sender_last_name, 
m.messagecontent, 
m.hasread,
m.receiverid,
u2.firstname AS receiver_first_name, 
u2.lastname AS receiver_last_name
FROM messages AS m
INNER JOIN users AS u1 ON u1.userid = m.senderid
LEFT JOIN users AS u2 ON m.receiverid = u2.userid;




CREATE VIEW friends_view AS
select 
u1.userid AS left_friendid, 
u1.firstname AS left_friend_first_name,
u1.lastname AS left_friend_last_name, 
cf.rightid AS right_friendid, 
u2.firstname AS right_friend_first_name, 
u2.lastname AS right_friend_last_name
FROM connected_friends AS cf
INNER JOIN users AS u1 ON u1.userid = cf.leftid
LEFT JOIN users AS u2 ON cf.rightid = u2.userid;




/*
Entertainer table - generic user for service - without gigs or artist connect functionality
*/
CREATE TABLE entertainers (
    entid int not null auto_increment,
    authid int not null,
    firstName varchar(50),
    lastName varchar(50),
    ratePerHour decimal(15,2),
    workDescription varchar(200),
    profilePicture varchar(100),
    homePagePicture varchar(100),
    homePageVideo varchar(100),
    aboutMe varchar(400),
    myQuote varchar(400),
    profileStatus int,
    

    FOREIGN KEY (authid) REFERENCES authentication(authid),
    PRIMARY KEY (entid)
); 


/*
Gigs table - stores details about a specific entertainer gig
*/
CREATE TABLE gigs (
    gigsid int not null auto_increment,
    entid int not null,
    gigsName varchar(70) not null,
    gigsCategory varchar(70) not null,
    gigsLabel varchar(20),
    gigsArtType varchar(70) not null,
    gigsDetails varchar(200),
    notes varchar(100),

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    primary key (gigsid)
);

CREATE TABLE gigsPendingBookings (
    pendingBookingId int not null auto_increment,
    gigsid int not null,
    
    FOREIGN KEY (gigsid) REFERENCES gigs(gigsid),
    primary key (pendingBookingId)
);




/*
Occupation table - stores a list of entertainers occupation eg, Musician, Singer etc
*/
CREATE TABLE occupation (
    occid int not null auto_increment,
    entid int not null,
    occupation varchar(30) not null,

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    primary key (occid)
);


/*
Gigs Image table - stores the location of a gigs images
*/
CREATE TABLE gigsImages (
    gigsImageid int not null auto_increment,
    gigsid int not null,
    gigsImageLocation varchar(100),
    
    FOREIGN KEY (gigsid) REFERENCES gigs(gigsid),
    primary key (gigsImageid)
);


CREATE TABLE entertainerVideos (
    entVideoId int not null auto_increment,
    entId int not null,
    entVideoEmbedCode varchar(100),
    
    FOREIGN KEY (entId) REFERENCES entertainers(entId),
    primary key (entVideoId)
);




/*
entertainerAvailability table - stores all the available dates and times for all entertainers and or venues
*/
CREATE TABLE entertainerAvailability (
    availId int not null auto_increment,
    entid int not null,
    availStartDate date not null,
    availEndDate date,
    availStartTime time not null,
    availEndTime time not null,
    availTitle varchar(50),

	FOREIGN KEY (entid) REFERENCES entertainers(entid),
    primary key (availId)
);


/*
Event planner table - stores details about a specific event planner
*/
CREATE TABLE eventPlanners (
    eventPlannerId int not null auto_increment,
    authid int not null,
    firstName varchar(50),
    lastName varchar(50),
    imageLocation varchar(100),

    FOREIGN KEY (authid) REFERENCES authentication(authid),
    PRIMARY KEY (eventPlannerId)
);


CREATE TABLE venueOwners (
    venueOwnerId int not null auto_increment,
    authid int not null,
    firstName varchar(50),
    lastName varchar(50),
    imageLocation varchar(100),

    FOREIGN KEY (authid) REFERENCES authentication(authid),
    PRIMARY KEY (venueOwnerId)
);


/*
Venues table - stores details about a venue
*/
CREATE TABLE venues (
    venueId int not null auto_increment,
    venueOwnerId int not null,
    venueName varchar(50),
    venueCity varchar(70),
    venueState varchar(70),
    venueProvince varchar(70),
	venueDescription varchar(200),
    venuePicture varchar(100),

	FOREIGN KEY (venueOwnerId) REFERENCES venueOwners(venueOwnerId),
    PRIMARY KEY (venueId)
);


CREATE TABLE venueVideos (
    venueVideoid int not null auto_increment,
    venueId int not null,
    venueVideoEmbedCode varchar(100),
    
    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (venueVideoid)
);

CREATE TABLE venuePendingBookings (
    pendingBookingId int not null auto_increment,
    venueId int not null,
    
    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (pendingBookingId)
);


CREATE TABLE venueAvailability (
    availId int not null auto_increment,
    venueId int not null,
    availStartDate date not null,
    availEndDate date,
    availStartTime time not null,
    availEndTime time not null,
    availTitle varchar(50),

	FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (availId)
);



/*
bookingRequests table - stores notifications that will be sent to an entertainer for a performance request
*/
CREATE TABLE bookingRequests (
    bookingReqId int not null auto_increment,
    entid int not null,
	eventPlannerId int,
	venueOwnerId int,
	message varchar(200),

	FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (eventPlannerId) REFERENCES eventPlanners(eventPlannerId),
	FOREIGN KEY (venueOwnerId) REFERENCES venueOwners(venueOwnerId),
    PRIMARY KEY (bookingReqId)
);


/*
Booked Gigs table - stores details about a specific entertainer gig that has been booked by an event planner or venue
*/
CREATE TABLE bookedGigs (
    bookedGigsId int not null auto_increment,
    entid int not null,
    gigsid int not null,
    eventPlannerId int,
    venueOwnerId int,
    venueId int,
    event_name varchar(50) not null,
    event_date date not null,
    event_description varchar(250) not null,

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (gigsid) REFERENCES gigs(gigsid),
    FOREIGN KEY (eventPlannerId) REFERENCES eventPlanners(eventPlannerId),
    FOREIGN KEY (venueOwnerId) REFERENCES venueOwners(venueOwnerId),
    primary key (bookedGigsId)
);


/*
Booked Venues table - stores details about a specific venue that has been booked by an event planner. 
*/
CREATE TABLE bookedVenues (
    bookedVenuesId int not null auto_increment,
    eventPlannerId int not null,
    venueId int not null,

    FOREIGN KEY (eventPlannerId) REFERENCES eventPlanners(eventPlannerId),
    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (bookedVenuesId)
);


CREATE TABLE entertainerBookingNotifications (
    notificationId int not null auto_increment,
    notificationType int not null,
    entid int not null,
    gigsid int not null,
    venue varchar(20) not null,
    event_date date not null,
    requestorEmail varchar(20) not null,
    message varchar(100),

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (gigsid) REFERENCES gigs(gigsid),
    primary key (notificationId)
);

CREATE TABLE venueBookingNotifications (
    notificationId int not null auto_increment,
    notificationType int not null,
    venueId int not null,
    requestorEmail varchar(20) not null,
    message varchar(100),

    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (notificationId)
);


CREATE TABLE venueOwnerNotifications (
    notificationId int not null auto_increment,
    notificationType int not null,
    venueOwnerId int not null,
    entid int not null,
    message varchar(100),

    FOREIGN KEY (venueOwnerId) REFERENCES venueOwners(venueOwnerId),
    primary key (notificationId)
);


CREATE TABLE eventPlannerNotifications (
    notificationId int not null auto_increment,
    notificationType int not null,
    eventPlannerId int not null,
    entid int not null,
    message varchar(100),

    FOREIGN KEY (eventPlannerId) REFERENCES eventPlanners(eventPlannerId),
    primary key (notificationId)
);






CREATE View gigsDetails as 
(SELECT availStartDate, availEndDate, availStartTime, availEndTime, entertainers.entid, firstName, lastName, ratePerHour, aboutMe, gigsName, gigsCategory, gigsArtType, gigsDetails, notes 
FROM entertainers INNER JOIN gigs ON
entertainers.entid = gigs.entid INNER JOIN entertainerAvailability ON
entertainerAvailability.entid = entertainers.entid
);


/*
SELECT availStartDate, availEndDate, availStartTime, availEndTime, entertainers.entid, firstName, lastName, ratePerHour, aboutMe, gigsName, gigsCategory, gigsArtType, gigsDetails, notes

FROM entertainerAvailability INNER JOIN entertainers ON
entertainerAvailability.entid = entertainers.entid INNER JOIN gigs ON
entertainers.entid = gigs.entid INNER JOIN gigsimages ON
gigs.gigsid = gigsimages.gigsid
*/



CREATE View bookedGigsDetails as 
(
select bookedGigsId, bookedgigs.venueOwnerId,eventplanners.eventPlannerId, gigs.gigsId, bookedgigs.entid, gigsName, gigsDetails, event_date, venueName, venueCity, venueProvince, firstName, lastName, email, event_description, event_name  
from bookedgigs INNER JOIN gigs ON 
gigs.gigsid = bookedgigs.gigsid inner join eventplanners ON 
bookedgigs.eventPlannerId = eventplanners.eventPlannerId JOIN venues ON 
bookedgigs.venueId = venues.venueId JOIN authentication ON
eventplanners.authid = authentication.authid
);

ALTER TABLE `bookingrequests`  ADD `gigsid` INT NOT NULL  AFTER `venueOwnerId`,  ADD `venueid` INT NOT NULL  AFTER `gigsid`,  ADD `event_name` VARCHAR(50) NOT NULL  AFTER `venueid`,  ADD `event_date` DATE NOT NULL  AFTER `event_name`,  ADD `event_description` VARCHAR(250) NOT NULL  AFTER `event_date`;

ALTER TABLE `bookingrequests` ADD CONSTRAINT `bookingrequests_ibfk_4` FOREIGN KEY (`gigsid`) REFERENCES `gigs`(`gigsid`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `bookingrequests` ADD CONSTRAINT `bookingrequests_ibfk_5` FOREIGN KEY (`venueid`) REFERENCES `venues`(`venueId`) ON DELETE RESTRICT ON UPDATE RESTRICT;




insert into artforms (formname) values ('musician');
SELECT @art_musician := LAST_INSERT_ID( );
insert into artforms (formname) values ('dancer');
SELECT @art_dancer := LAST_INSERT_ID( );
insert into artforms (formname) values ('painter');
SELECT @art_painter := LAST_INSERT_ID( );
insert into artforms (formname) values ('actor');
SELECT @art_actor := LAST_INSERT_ID( );
insert into artforms (formname) values ('model');
SELECT @art_model := LAST_INSERT_ID( );
insert into artforms (formname) values ('singer');
SELECT @art_singer := LAST_INSERT_ID( );
insert into artforms (formname) values ('photographer');
SELECT @art_photographer := LAST_INSERT_ID( );
insert into artforms (formname) values ('blogger');
SELECT @art_blogger := LAST_INSERT_ID( );


insert into interests (interestname) values ('event');
SELECT @int_event := LAST_INSERT_ID( );
insert into interests (interestname)values ('music');
SELECT @int_music := LAST_INSERT_ID( );
insert into interests (interestname) values ('concert');
SELECT @int_concert := LAST_INSERT_ID( );
insert into interests (interestname) values ('festival');
SELECT @int_festival := LAST_INSERT_ID( );
insert into interests (interestname)values ('party');
SELECT @int_party := LAST_INSERT_ID( );




insert into authentication (email,pass) values ('andrew@archibald.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Andrew','Archibald');

/**
SELECT @eventplanners_id := LAST_INSERT_ID( ); -- gives us eventplanners id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Ottawa','Ontario','Canada',@eventplanners_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('Andrew@archibald.com','613-000-0000',@eventplanners_id,true,false);
set @receive:=@eventplanners_id-1;


-- insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'Hello Andrew',false);
-- insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_event,@art_id);
insert into artist_artform (artformid,artistid) values (@art_dancer,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'edwardtarte', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('mike@smith.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Mike','Smith');

/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Ottawa','Ontario','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('mike@smith.com','613-100-0001',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'I do not know him. Who is he?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_festival,@art_id);
insert into artist_artform (artformid,artistid) values (@art_photographer,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'davie504', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('oksana@shapoval.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Oksana','Shapoval');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Ottawa','Ontario','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('oksana@shapoval.com','613-100-8090',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'How are you today?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_concert,@art_id);
insert into artist_artform (artformid,artistid) values (@art_dancer,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'BobRossInc', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('svetlana@netchaeva.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Svetlana','Netchaeva');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Toronto','Ontario','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('svetlana@netchaeva.com','613-100-8330',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'We have a nice database design?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_concert,@art_id);
insert into artist_artform (artformid,artistid) values (@art_musician,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'davie504', 'i am a foodie', ' \r\n				test2		');
**/


insert into authentication (email,pass) values ('zeyang@hu.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Zyang','Hu');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('London','Ontario','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('zeyang@hu.com','613-100-5550',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,' !',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_event,@art_id);
insert into artist_artform (artformid,artistid) values (@art_singer,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'davie504', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('minyi@yang.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Minyi','Yang');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Ottawa','Ontario','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('minyi@yang.com','613-145-8090',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'Hi!',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_festival,@art_id);
insert into artist_artform (artformid,artistid) values (@art_dancer,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'BobRossInc', 'i am a foodie', ' \r\n				test2		');
**/


insert into authentication (email,pass) values ('ksenia@lopukhina.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Ksenia','Lopukhina');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Montreal','Quebec','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('ksenia@lopukhina.com','613-900-8090',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'what about tomorrow?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_party,@art_id);
insert into artist_artform (artformid,artistid) values (@art_actor,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', 'BobRossInc', 'i am a foodie', ' \r\n				test2		');
**/


insert into authentication (email,pass) values ('John@Logan.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'John','Logan');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Montreal','Quebec','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('name@name.com','613-510-1123',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'what about tomorrow?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_party,@art_id);
insert into artist_artform (artformid,artistid) values (@art_actor,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', '', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('Marty@McFly.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Marty','McFly');
/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Montreal','Quebec','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('Marty@McFly.com','613-510-1123',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'what 1about tomorrow?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_party,@art_id);
insert into artist_artform (artformid,artistid) values (@art_actor,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', ' ', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('Mary@Ross.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Mary','Ross');

/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Montreal','Quebec','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('Mary@Ross.com','613-510-1123',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'what about tomorrow?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_party,@art_id);
insert into artist_artform (artformid,artistid) values (@art_actor,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', ' ', 'i am a foodie', ' \r\n				test2		');
**/

insert into authentication (email,pass) values ('Tommy@Roland.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Tommy','Roland');

/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Montreal','Quebec','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('Tommy@Roland.com','613-510-1123',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'what about tomorrow?',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_party,@art_id);
insert into artist_artform (artformid,artistid) values (@art_actor,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', ' ', 'i am a foodie', ' \r\n				test2		');
**/


insert into authentication (email,pass) values ('Rocky@Johnson.com','password');
SELECT @auth_id := last_insert_id();
insert into eventplanners (authid,firstname,lastname) values (@auth_id,'Rocky','Johnson');

/**
SELECT @user_id := LAST_INSERT_ID( ); -- gives us user id from the insert above
insert into address (city,province,country,userid,publicaddress) values ('Ottawa','Ontario','Canada',@user_id,true);
insert into contact (email, phonenumber, userid, publicemail, publicphone) values ('Rocky@Johnson.com','613-145-8090',@user_id,true,false);
set @receive:=@user_id-1;
insert into messages (senderid, receiverid, messagecontent, hasread) values (@user_id,@receive,'Hi!',false);
insert into connected_friends (leftid, rightid,confirmright) values (@user_id,@receive,true);
insert into artists (userid) values(@user_id);
SELECT @art_id := LAST_INSERT_ID( ); 
insert into artist_interest (interestid,artistid) values (@int_festival,@art_id);
insert into artist_artform (artformid,artistid) values (@art_dancer,@art_id);
insert into artprofile (artistid, text1,text2,text3,text4,`socialid`, `shareurl`, `bio`, `urldes`) values (@art_id,'Hobby','Hockey','Swimming','Skating','Hobby', ' ', 'i am a foodie', ' \r\n				test2		');

Insert into connected_friends (leftid, rightid, confirmright) values (5,1,0);
Insert into connected_friends (leftid, rightid, confirmright) values (1,3,0);
Insert into connected_friends (leftid, rightid, confirmright) values (4,1,1);
Insert into connected_friends (leftid, rightid, confirmright) values (6,1,1);
Insert into connected_friends (leftid, rightid, confirmright) values (1,7,0);
Insert into connected_friends (leftid, rightid, confirmright) values (8,1,1);


INSERT INTO `experience` (`experienceid`, `experiencetitle`, `experiencedes`, `experiencetime`, `profileid`) VALUES
(1, 'designer', 'Graphic design work, particulary things', '2018.09-now', 1),
(2, 'dancer', 'Dance is a performing art form consisting of purposefully selected sequences of human movement. ', '', 2),
(8, 'student', 'Studied as an art student', '2015-2019', 1),
(9, 'student', 'Studied as an art student', '2015-2019', 2),
(10, 'student', 'Studied as an art student', '2015-2019', 3),
(11, 'student', 'Studied as an art student', '2015-2019', 4),
(12, 'student', 'Studied as an art student', '2015-2019', 5),
(13, 'student', 'Studied as an art student', '2015-2019', 6),
(14, 'student', 'Studied as an art student', '2015-2019', 7);

insert into feeds values(1, 'Working on a new project',current_time());
insert into feeds values(2, ' not too busy ',current_time());
insert into feeds values(3, ' Working hard, or hardly working?',current_time());
insert into feeds values(4, ' Looking for work ',current_time());
insert into feeds values(5, ' Finally a day off ',current_time());
insert into feeds values(6, '  Anyone else think cats are strange?  ',current_time());
insert into feeds values(7, "Is space real if you can't see it? ",current_time());
insert into feeds values(7, 'Ksenia is a pro in GitHub',current_time()); 
**/


INSERT into authentication (email,pass, userType) VALUES ('silas@fish.com','password', 2);
INSERT into authentication (email,pass, userType) VALUES ('keller@mathew.com','password', 2);
INSERT into authentication (email,pass, userType) VALUES ('Sam@Erikzon.com','password', 2);
INSERT into authentication (email,pass, userType) VALUES ('Etlana@Fries.com','password', 2);

INSERT into authentication (email,pass, userType) VALUES ('madison@kindler.com','password', 3);
INSERT into authentication (email,pass, userType) VALUES ('kellerman@comb.com','password', 3);

UPDATE authentication SET userType = 1 WHERE authid = 1;
UPDATE authentication SET userType = 1 WHERE authid = 2;
UPDATE authentication SET userType = 1 WHERE authid = 3;
UPDATE authentication SET userType = 1 WHERE authid = 4;
UPDATE authentication SET userType = 1 WHERE authid = 5;
UPDATE authentication SET userType = 1 WHERE authid = 6;
UPDATE authentication SET userType = 1 WHERE authid = 7;
UPDATE authentication SET userType = 1 WHERE authid = 8;
UPDATE authentication SET userType = 1 WHERE authid = 9;
UPDATE authentication SET userType = 1 WHERE authid = 10;
UPDATE authentication SET userType = 1 WHERE authid = 11;
UPDATE authentication SET userType = 1 WHERE authid = 12;



INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, profilePicture, aboutMe) VALUES 
							(13,'Silas','Fish', 15, 'F4.jpg','I am a nice little twitter bird');

INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, profilePicture, aboutMe) VALUES 
							(14,'Keller','Mathew', 35.6, 'M1.jpg','Cover Band');

INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, profilePicture, aboutMe) VALUES 
							(15,'Sam','Erikzon', 75.8, 'F3.jpg','The ultimate show of a life time. Come and be blown away');
							
INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, profilePicture, aboutMe) VALUES 
							(16,'Etlana','Fries', 98.56,  'pro-photo.jpg','I have been playing music all my life and I play professionally over 3 instruments. I also know how to create my own music, including song lyrics.');



INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (1,'Sotie Special','Concert','Singer','test gig to add','notes');

INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (2,'The Fire Watch','Concert','Dancer','A new gig to watch the fire','notes');
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (2,'Titans Glory','Concert','Musician','Titans Glory is an American rock band formed in New York City in January 1973 by Paul Stanley, Gene Simmons, Peter Criss, and Ace Frehley. Well known for its members face paint and stage outfits, the group rose to prominence in the mid-to-late 1970s with their elaborate live performances, which featured fire breathing. ','notes');
    	                       
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (1,'The bloosom of doom','Festival','Artist','The bloosom of doom is a rich and entertaining show','dont come if you can easily get scared');
    	                       
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (1,'Photography with Kenny','Party','Photographer','a nice photography session', '');
    	                       
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (4,'Bouncey Cat','Party','Photographer','Come play with some meow meow cats', 'The big cats, big and scary cats but love to play');
    	                       
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (3,'Laugh your guts out','Party','Comedian','Forget about your sorrows. Come and laugh and dine', 'laugh out loud');
    	                       
    	                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 1, 'chad-kirchoff-ivqGyYLtBI8-unsplash.jpg'); 
                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 2, 'img7.jpg');
                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 3, 'img8.jpg');
                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 4, 'maxime-bhm-icyZmdkCGZ0-unsplash.jpg');
                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 5, 'samplevenue1.jpg');
                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 6, 'vidar-nordli-mathisen-JoxgCs5h8FA-unsplash.jpg'); 
                       
INSERT INTO gigsimages ( gigsid, gigsImageLocation) values
                       ( 7, 'photo-1460723237483-7a6dc9d0b212.jpg');
    
    	                       

INSERT INTO entertainerAvailability (entid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) VALUES 
							(1, '2020-03-12','2020-03-12', '15:00', '16:00', 'Birthday Party'); 
							
INSERT INTO entertainerAvailability (entid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) VALUES 
							(2, '2020-03-12','2020-06-12', '16:00', '16:00', 'Lunch'); 	
							
INSERT INTO entertainerAvailability (entid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) VALUES 
							(3, '2020-03-12','2020-09-12', '17:00', '16:00', 'Meeting');	
							
INSERT INTO entertainerAvailability (entid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) VALUES 
							(4, '2020-03-12','2020-03-15', '17:00', '16:00', 'All Day Event');	
	
INSERT INTO entertainerAvailability (entid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) VALUES 
							(4, '2020-03-18','2020-03-20', '17:00', '16:00', 'Music Festival');		
							
					

INSERT INTO venueOwners ( authid, firstName, lastName) VALUES 
					    (17, 'Madison', 'Kindler');
					    
INSERT INTO venueOwners ( authid, firstName, lastName) VALUES 
					    (18, 'Kellerman', 'Comb');

INSERT INTO venues (venueOwnerId, venueName, venueCity, venueState, venueProvince, venueDescription, venuePicture) VALUES 
					 (1, 'National Arts Centre', 'Ottawa', NULL, 'Ontario', 'Major arts gallery', 'NAC.jpg');
					 
INSERT INTO venues (venueOwnerId, venueName, venueCity, venueState, venueProvince, venueDescription, venuePicture) VALUES 
					 (2, 'Canadian Tire Center', 'Ottawa', NULL, 'Ontario', 'Large sports centre for concerts', 'img8.jpg');
					 
INSERT INTO venues (venueOwnerId, venueName, venueCity, venueState, venueProvince, venueDescription, venuePicture) VALUES 
					 (2, 'My backyard', 'Ottawa', NULL, 'Ontario', 'A suburban yard', 'yard.jpg');
				
INSERT INTO venues (venueOwnerId, venueName, venueCity, venueProvince, venueDescription, venuePicture) VALUES 
                     (1, 'TestVenue', 'Ottawa', 'Ontario', 'a description', 'NAC.jpg');
                     
                     
INSERT INTO venueAvailability (venueid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) VALUES 
							(1, '2020-03-18','2020-03-20', '17:00', '16:00', 'Booked');						

					 
					 
INSERT INTO bookedvenues (eventPlannerId, venueId) VALUES 
					     (1, 1);
					     
INSERT INTO bookedvenues (eventPlannerId, venueId) VALUES 
					     (2, 2);
					     
INSERT INTO bookedvenues (eventPlannerId, venueId) VALUES 
					     (3, 1);
					 
INSERT INTO bookedvenues (eventPlannerId, venueId) VALUES 
					     (4, 2);
					     
INSERT INTO bookedvenues (eventPlannerId, venueId) VALUES 
					     (5, 1);
					 

INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (1,3, 1,1,1, 'Birthday surprise','2020-04-10','Your birthday is the day of your birth! Its the yearly anniversary that marks the day you were born'); 
INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (2,3, 2,1,2, 'Wedding','2020-04-11','A wedding is a ceremony where two or more people are united in marriage. ... Most wedding ceremonies involve an exchange of marriage vows by a couple');	
INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (2,2, 3,2,1, 'DJ','2020-04-18','Disc Jockeys, also known as DJs, play musical recordings on radio shows, at nightclubs, and at public events. DJs mostly work for radio stations presenting programs, talks shows, and chart shows');
INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (3,4, 1,2,2, 'Party all Night','2020-04-19','A party is a gathering of people who have been invited by a host for the purposes of socializing, conversation, recreation, or as part of a festival or other commemoration of a special occasion.');
INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (4,6, 2,1,1, 'Concert in my Living room','2020-04-19','Here are some adjectives for concert: sonorous and never-ending, usual open-air, modest chamber-music, constant and outrageous, mournfal, strange and mournfal, next sold-out, fine matinee, unannounced free, high-quality full-sized, open or private, rival canine, delightful gratuitous, strange but not inharmonious');
INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (4,6, 3,1,1, 'Photography','2020-04-17','Photographers are artists with the camera, using a blend of technical skills and an artistic eye to take pictures of people, places, landscapes');
INSERT INTO bookedgigs (entid, gigsid, eventPlannerId, venueOwnerId, venueId, event_name, event_date, event_description) VALUES (4,6, 1,1,1, 'Model','2020-04-12','Models promote, advertise, and showcase clothing, footwear, and other products. They participate in photoshoots, fashion shows, commercials, trade shows, and conventions as well as pose for sculptors, artists, and painters');


INSERT INTO occupation (entid, occupation) VALUES (1, "Dancer");
INSERT INTO occupation (entid, occupation) VALUES (1, "Singer");
INSERT INTO occupation (entid, occupation) VALUES (2, "Model");
INSERT INTO occupation (entid, occupation) VALUES (4, "Photographer");
INSERT INTO occupation (entid, occupation) VALUES (4, "Model");
INSERT INTO occupation (entid, occupation) VALUES (3, "Model");
INSERT INTO occupation (entid, occupation) VALUES (1, "Comedian");
INSERT INTO occupation (entid, occupation) VALUES (3, "DJ");

insert into entertainerVideos(entid, entVideoEmbedCode) VALUES (4, '<iframe width="1263" height="480" src="https://www.youtube.com/embed/uJ74cXI6KYg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
insert into venueVideos(venueid, venueVideoEmbedCode) VALUES (1, '<iframe width="1263" height="480" src="https://www.youtube.com/embed/9ScwCBQkhIY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');

					 
/*
INSERT INTO `eventplanners` (`authid`, `firstName`, `lastName`, `imageLocation`) VALUES 
                            ('1', 'Andrew', 'Archibald', NULL);

INSERT INTO `entertainerAvailability` (`availStartDate`, `availEndDate`, `availStartTime`, `availEndTime`) VALUES 
                           ('2020-02-09', '2020-02-09', '18:00:00', '21:00:00');

INSERT INTO `resourceentertainerAvailability` (`entid`, `availId`, `venueId`) VALUES 
								(NULL, '1', '1');
*/

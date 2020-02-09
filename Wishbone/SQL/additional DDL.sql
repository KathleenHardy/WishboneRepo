drop table if exists bookedVenues;
drop table if exists bookedGigs;
drop table if exists resourceAvailability;
drop table if exists venues;
drop table if exists eventPlanners;
drop table if exists availability;
drop table if exists gigsImages;
drop table if exists gigs;
drop table if exists entertainers;
drop view  if exists gigsDetails;


/*
Entertainer table - generic user for service - without gigs or artist connect functionality
*/
CREATE TABLE entertainers (
    entid int not null auto_increment,
    authid int not null,
    firstName varchar(50),
    lastName varchar(50),
    ratePerHour decimal(15,2),
    imageLocation varchar(100),
    homePagePicture varchar(100),
    aboutMe varchar(400),
    

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
    gigsArtType varchar(70) not null,
    gigsDetails varchar(200),
    notes varchar(100),

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    primary key (gigsid)
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




/*
Availability table - stores all the available dates and times for all entertainers and or venues
*/
CREATE TABLE availability (
    availId int not null auto_increment,
    availStartDate date not null,
    availEndDate date,
    availStartTime time not null,
    availEndTime time not null,

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


/*
Venues table - stores details about a venue
*/
CREATE TABLE venues (
    venueId int not null auto_increment,
    venueName varchar(50),
    venueCity varchar(70),
    venueState varchar(70),
    venueProvince varchar(70),

    PRIMARY KEY (venueId)
);



/*
Resource Availability table - stores details about a specific entertainer's nad venue's availability
*/
CREATE TABLE resourceAvailability (
    resAvailId int not null auto_increment,
    entid int,
    availId int not null,
    venueId int,

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (availId) REFERENCES availability(availId),
    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (resAvailId)
);


/*
Booked Gigs table - stores details about a specific entertainer gig that has been booked by an event planner or venue
*/
CREATE TABLE bookedGigs (
    bookedGigsId int not null auto_increment,
    entid int not null,
    gigsid int not null,
    resAvailId int not null,
    eventPlannerId int,
    venueId int,

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (gigsid) REFERENCES gigs(gigsid),
    FOREIGN KEY (resAvailId) REFERENCES resourceAvailability(resAvailId),
    FOREIGN KEY (eventPlannerId) REFERENCES eventPlanners(eventPlannerId),
    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (bookedGigsId)
);


/*
Booked Venues table - stores details about a specific venue that has been booked by an event planner. 
*/
CREATE TABLE bookedVenues (
    bookedVenuesId int not null auto_increment,
    resAvailId int not null,
    eventPlannerId int not null,
    venueId int not null,

    FOREIGN KEY (resAvailId) REFERENCES resourceAvailability(resAvailId),
    FOREIGN KEY (eventPlannerId) REFERENCES eventPlanners(eventPlannerId),
    FOREIGN KEY (venueId) REFERENCES venues(venueId),
    primary key (bookedVenuesId)
);


ALTER TABLE bookedGigs ADD FOREIGN KEY (resAvailId) REFERENCES resourceAvailability(resAvailId);


CREATE View gigsDetails as 
(
SELECT availStartDate, availEndDate, availStartTime, availEndTime, firstName, lastName, ratePerHour, aboutMe, gigsName, gigsCategory, gigsArtType, gigsDetails, notes
FROM entertainers INNER JOIN gigs ON
entertainers.entid = gigs.entid INNER JOIN bookedgigs ON
gigs.gigsid = bookedgigs.gigsid INNER JOIN resourceavailability ON
resourceavailability.resAvailId = bookedgigs.resAvailId INNER JOIN availability ON
availability.availId = resourceavailability.availId
);







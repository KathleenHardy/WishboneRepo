drop table if exists bookedGigs;
drop table if exists entertainerAvailability;
drop table if exists availability;
drop table if exists gigs;
drop table if exists entertainers;


/*
Entertainer table - generic user for service - without gigs or artist connect functionality
*/
CREATE TABLE entertainers (
    entid int not null auto_increment,
    authid int not null,
    firstname varchar(50),
    lastname varchar(50),
    imagelocation varchar(100),

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
    gigscategory varchar(70) not null,
    gigstype varchar(70) not null,
    location varchar(70) not null,
    gigsdetails varchar(200),
    notes varchar(100),

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    primary key (gigsid)
);


/*
Availability table - stores all the available dates and times for all entertainers
*/
CREATE TABLE availability (
    availId int not null auto_increment,
    availDate date,
    availStartTime time,
    availEndTime time,

    primary key (availId)
);



/*
Entertainer Availability table - stores details about a specific entertainer's availability
*/
CREATE TABLE entertainerAvailability (
    entAvailId int not null auto_increment,
    entid int not null,
    availId int not null,

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (availId) REFERENCES availability(availId),
    primary key (entAvailId)
);



/*
Booked Gigs table - stores details about a specific entertainer gig that has been booked by an event planner or venue
*/
CREATE TABLE bookedGigs (
    bookedGigsId int not null auto_increment,
    entid int not null,
    gigsid int not null,
    entAvailId int not null,

    FOREIGN KEY (entid) REFERENCES entertainers(entid),
    FOREIGN KEY (gigsid) REFERENCES gigs(gigsid),
    FOREIGN KEY (entAvailId) REFERENCES entertainerAvailability(entAvailId),
    primary key (bookedGigsId)
);


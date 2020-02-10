INSERT into authentication (email,pass, userType) VALUES ('andw@archibald.com','password', 2);
INSERT into authentication (email,pass, userType) VALUES ('aw@archibald.com','password', 2);
INSERT into authentication (email,pass, userType) VALUES ('ndrew@archibald.com','password', 2);


INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, aboutMe) VALUES 
							(12,'Silas','Fish', 15, 'I am a nice little twitter bird');

INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, aboutMe) VALUES 
							(13,'Keller','Mathew', 35.6, 'Cover Band');

INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, aboutMe) VALUES 
							(14,'Sotie','Erikzon', 75.8, 'The ultimate show of a life time. Come and be blown away');
							
INSERT INTO entertainers (authid, firstName, lastName, ratePerHour, aboutMe) VALUES 
							(4,'Etlana','Fries', 15, 'Maecenas lorem ex, euismod eget pulvinar non, facilisis ut leo. Quisque placerat purus in neque efficitur ornare. Nam at justo magna. Aliquam venenatis odio ante, non euismod augue porttitor eget. Maecenas nec viverra eros,');


INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (1,'Sotie Special','Concert','Singer','test gig to add','notes');

INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (2,'The Fire Watch','Concert','Dancer','A new gig to watch the fire','notes');
    	                       
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (1,'The bloosom of doom','Festival','Artist','The bloosom of doom is a rich and entertaining show','dont come if you can easily get scared');
    	                       
    	                       
INSERT INTO gigs (entid, gigsName, gigsCategory, gigsArttype, gigsDetails, notes) VALUES 
    	                       (1,'Photography with Kenny','Party','Photographer','a nice photography session', '');
    	                       

INSERT INTO availability (availStartDate, availEndDate, availStartTime, availEndTime) VALUES 
							('2020-02-12','2020-03-12', '15:00', '16:00'); 	
							

INSERT INTO resourceavailability (entid, availId) VALUES (1, 1);
INSERT INTO resourceavailability (entid, availId) VALUES (2, 1);

INSERT INTO bookedgigs (entid, gigsid, resAvailId) VALUES (1,3, 1); 	
INSERT INTO bookedgigs (entid, gigsid, resAvailId) VALUES (2,2, 1);






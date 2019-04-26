\c postgres

 

DROP DATABASE EVENT_MANAGEMENT;

 

CREATE DATABASE EVENT_MANAGEMENT;

 

\c event_management

 

CREATE TABLE FEST

(             Fname VARCHAR(20) PRIMARY KEY,

                Chief_mentor VARCHAR(20) ,

                Organising_secretary VARCHAR(20),

                OS_phone CHAR(10),

                Start_date DATE,

                End_date DATE,

                Fest_room VARCHAR(10),

                CHECK(End_date > Start_date)

);

 

CREATE TABLE BUDGET

(

                Total_amt REAL CHECK (Total_amt > 0.0 ),

               Budget_id VARCHAR(20),

               Amt_paid REAL,

               Amt_due REAL CHECK(Amt_due=Total_amt-Amt_paid) , -- derived

               PRIMARY KEY (Budget_id)

);

CREATE TABLE EVENT

(

               Start_time TIME,

               Evt_date DATE,

               Ename VARCHAR(30),

               Evt_venue VARCHAR(30),

               Ecoord_name VARCHAR(20),

                Ecoord_id VARCHAR(10),

               Ecoord_phone CHAR(10),

               Ecoord_email VARCHAR(30),

                Budget_id_fk_event VARCHAR(20) REFERENCES BUDGET(budget_id) ON UPDATE CASCADE ON DELETE SET NULL,

               Fname_fk VARCHAR(20) REFERENCES FEST(Fname) ON UPDATE CASCADE ON DELETE CASCADE ,

               PRIMARY KEY(Ename)

 );

CREATE TABLE DOMAINS

(

               Dname VARCHAR(30),

               Dcoord_name VARCHAR(20),

                Dcoord_id VARCHAR(10),

                Dcoord_phone CHAR(10),

               Dcoord_email VARCHAR(30),

               Fname_fk VARCHAR(20) REFERENCES FEST(Fname) ON UPDATE CASCADE ON DELETE CASCADE,

                Budget_id_fk_domains VARCHAR(20) REFERENCES BUDGET(budget_id) ON UPDATE CASCADE ON DELETE SET NULL,

               PRIMARY KEY(Dname,Fname_fk)

);

 

 CREATE TABLE TASK

(

                Task_id VARCHAR(10) PRIMARY KEY,

                Task_name VARCHAR(30) NOT NULL,

                Purpose VARCHAR(50) NOT NULL,

                Status VARCHAR(20) CHECK (Status IN('PENDING', 'ONGOING', 'COMPLETE')),

                Task_date DATE,

                Task_venue VARCHAR(40),

                -- Fname_fk VARCHAR(20) REFERENCES FEST(Fname) ON UPDATE CASCADE ON DELETE CASCADE

                Ename_fk VARCHAR(30) REFERENCES EVENT(Ename) ON UPDATE CASCADE ON DELETE CASCADE,

                Dname_fk VARCHAR(30),

                Fname_fk_T VARCHAR(30),

                FOREIGN KEY(Dname_fk,Fname_fk_T) REFERENCES DOMAINS(Dname,Fname_fk) ON UPDATE CASCADE ON DELETE CASCADE

);

 CREATE TABLE VOLUNTEER

(

               Vname VARCHAR(20),

               Vid VARCHAR(10),

               vphone CHAR(10),

               Total_amt REAL CHECK (Total_amt > 0.0),

               Amt_spent REAL CHECK (Amt_spent >= 0.0),

               Amt_due REAL CHECK(Amt_due = Total_amt-Amt_spent),

               Vemail_id VARCHAR(30),

               Dname_fk_V VARCHAR(30),

               Fname_fk_V VARCHAR(30),

               FOREIGN KEY(Dname_fk_V,Fname_fk_V) REFERENCES DOMAINS(Dname,Fname_fk) ON DELETE SET NULL ON UPDATE CASCADE,

               PRIMARY KEY(Vid)

);

CREATE TABLE CLASS

(

                Class_time TIME,

                Class_date DATE,

                Subject_code VARCHAR(10),

                Vid_fk CHAR(10) REFERENCES VOLUNTEER(Vid) ON DELETE CASCADE ON UPDATE CASCADE,

                PRIMARY KEY (Class_time, Class_date, Subject_code, Vid_fk)

 

);

 

CREATE TABLE WINNER

(

                Position VARCHAR(20),

                Prize_money REAL CHECK(Prize_money >= 0.0) NOT NULL,

                Ename_fk VARCHAR(30) REFERENCES EVENT(Ename) ON DELETE CASCADE ON UPDATE CASCADE,

                W_reg_id VARCHAR(10),

                PRIMARY KEY(W_reg_id,Ename_fk)

);

 

CREATE TABLE PARTICIPANTS

(

                Pname VARCHAR(30) ,

                Pemail VARCHAR(20),

                Reg_id VARCHAR(10),

                Pphone CHAR(10),

                PRIMARY KEY(Reg_id)

);

 

CREATE TABLE PARTICIPATES_IN

(

                Reg_id_fk VARCHAR(10) REFERENCES PARTICIPANTS(Reg_id) ON DELETE CASCADE ON UPDATE CASCADE,

                Ename_fk VARCHAR(30) REFERENCES EVENT(Ename) ON DELETE CASCADE ON UPDATE CASCADE,

                PRIMARY KEY(Reg_id_fk,Ename_fk)

);

 

CREATE TABLE WORKS_FOR

(

                Ename_fk VARCHAR(30) REFERENCES EVENT(Ename) ON DELETE CASCADE ON UPDATE CASCADE ,

                Vid_fk CHAR(10) REFERENCES VOLUNTEER(Vid) ON DELETE CASCADE ON UPDATE CASCADE,

                PRIMARY KEY(Ename_fk,Vid_fk)

);

 

CREATE TABLE PEOPLE_INVOLVED

(

                Task_pID VARCHAR(30),

                Task_id_fk CHAR(10) REFERENCES TASK(Task_id) ON DELETE CASCADE ON UPDATE CASCADE,

                PRIMARY KEY(Task_pID,Task_id_fk)

);

 

--MAKE THE VARCHAR FOR THE PURPOSE FIELD VARCHAR(50) I GAVE BIG DESCRIPTIONS

INSERT INTO FEST VALUES('Aatmatrisha 2019', 'Rohit Shukla', 'Anil Kumar', '9930312345', '09-02-2019', '10-03-2019', 'BG09-At');

 

 

INSERT INTO BUDGET VALUES(10000.0, 'At19F&c', 5000.0, 5000.0);

INSERT INTO BUDGET VALUES(5000.0, 'AtDISCO', 2500.0, 2500.0);

INSERT INTO BUDGET VALUES(20000.0, 'At19PR', 15000.0, 5000.0);

INSERT INTO BUDGET VALUES(10000.0, 'At19Log', 7000.0, 3000.0);

INSERT INTO BUDGET VALUES(15000.0, 'At19Reg', 5000.0, 10000.0);

INSERT INTO BUDGET VALUES(20000.0, 'At19Camp', 10000.0, 10000.0);

 

INSERT INTO BUDGET VALUES(500000.0, 'At19Con', 50000.0, 450000.0);

INSERT INTO BUDGET VALUES(40000.0, 'At19DS', 5000.0, 35000.0);

INSERT INTO BUDGET VALUES(5000.0, 'At19Dra', 4000.0, 1000.0);

INSERT INTO BUDGET VALUES(5000.0, 'At19DB', 2500.0, 2500.0);

INSERT INTO BUDGET VALUES(5000.0, 'At19OP', 2500.0, 2500.0);

INSERT INTO BUDGET VALUES(5000.0, 'At19FS', 2500.0, 2500.0);

 

 

INSERT INTO DOMAINS VALUES('Food and Catering', 'Aman Verma', 'DH00000001','9878234153', 'amanverma@gamil.com', 'Aatmatrisha 2019', 'At19F&c');

INSERT INTO DOMAINS VALUES('DISCO', 'Durga Mathur', 'DH00000002', '9087654097', 'durgamathur@gamil.com', 'Aatmatrisha 2019', 'AtDISCO');

INSERT INTO DOMAINS VALUES('Public Relations', 'Pavan Chaturvedi', 'DH00000003', '9086005411', 'pavanchaturvedi@gamil.com', 'Aatmatrisha 2019', 'At19PR');

INSERT INTO DOMAINS VALUES('Logistics', 'Kaveri Kumar', 'DH00000004', '9876050443', 'kaverikumard@gamil.com', 'Aatmatrisha 2019', 'At19Log');

INSERT INTO DOMAINS VALUES('Registrations', 'Kavita Sharma', 'DH00000005', '8691422312', 'kavitasharma@gamil.com', 'Aatmatrisha 2019', 'At19Reg');

INSERT INTO DOMAINS VALUES('Campaigning', 'Pavitra Nanda', 'DH00000006', '7099842136', 'pavitrananda@gamil.com', 'Aatmatrisha 2019', 'At19Camp');

 

 

INSERT INTO EVENT VALUES('19:00:00', '10-03-2019', 'Concert', 'College Ground', 'Amit Kumar', 'EH00000001', '7890678905', 'amitkumar@gmail.com', 'At19Con', 'Aatmatrisha 2019');

INSERT INTO EVENT VALUES('10:00:00', '04-03-2019', 'Dot Slash', 'Auditorium', 'Ankit Tiwari', 'EH00000002', '9890678905', 'akittiwari@gmail.com', 'At19DS', 'Aatmatrisha 2019');

INSERT INTO EVENT VALUES('10:30:00', '05-03-2019', 'Drama', 'Open Theatre', 'Aloknath', 'EH00000003', '7230655905', 'aloknath@gmail.com', 'At19Dra', 'Aatmatrisha 2019');

INSERT INTO EVENT VALUES('13:00:00', '09-03-2019', 'Dance Battle', 'Auditorium', 'Shivam Narayan', 'EH00000004', '9089123405', 'shivamnarayan@gmail.com', 'At19DB', 'Aatmatrisha 2019');

INSERT INTO EVENT VALUES('10:30:00', '01-03-2019', 'Open Mic', 'Open Theatre', 'Lalit Rao', 'EH00000005', '7098678905', 'lalitrao@gmail.com', 'At19OP', 'Aatmatrisha 2019');

INSERT INTO EVENT VALUES('11:00:00', '10-03-2019', 'Fashion Show', 'Student Lounge', 'Bhumi Pednekar', 'EH00000006', '9023145632', 'bhumipednekar@gmail.com', 'At19FS', 'Aatmatrisha 2019');

 

 

 

 

 

INSERT INTO VOLUNTEER VALUES('Emily               Burgess', 'At19Vol001', '9012345678', 200.0, 150.0, 50.0, 'emily.burgess@gmail.com', 'Food and Catering', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Carl Lewis', 'At19Vol002', '9002345678', 200.0, 150.0, 50.0, 'carllewis@gmail.com', 'Food and Catering', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER  VALUES('Jiya Thakkar', 'At19Vol003', '900345678', 200.0, 150.0, 50.0, 'jiyathakkar@gmail.com', 'Food and Catering', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER  VALUES('Javed Roy', 'At19Vol004', '9000005678', 200.0, 150.0, 50.0, 'javedroy@gmail.com', 'Food and Catering', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Vijayent Persad', 'At19Vol005', '9000000678', 200.0, 150.0, 50.0, 'vijeyant@gmail.com', 'Food and Catering', 'Aatmatrisha 2019');

 

INSERT INTO VOLUNTEER VALUES('Hernendra Dev', 'At19Vol006', '9090000678', 200.0, 150.0, 50.0, 'hermendra@gmail.com', 'DISCO', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Gauri Jain', 'At19Vol007', '9090780678', 200.0, 150.0, 50.0, 'gaurijain@gmail.com', 'DISCO', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Aditi Nayak', 'At19Vol008', '9096700678', 200.0, 150.0, 50.0, 'aditinayak@gmail.com', 'DISCO', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Kapil Sharma', 'At19Vol009', '9092340067', 200.0, 150.0, 50.0, 'kapilsharma@gmail.com', 'DISCO', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Bhairav Jain', 'At19Vol010', '9090002340', 200.0, 150.0, 50.0, 'bhairavjain@gmail.com', 'DISCO', 'Aatmatrisha 2019');

 

INSERT INTO VOLUNTEER VALUES('Sneha Nanda', 'At19Vol011', '9035622340', 200.0, 150.0, 50.0, 'snehananda@gmail.com', 'Public Relations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Aishwarya Harkari', 'At19Vol012', '9911122340', 200.0, 150.0, 50.0, 'aishwaryaharkari@gmail.com', 'Public Relations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Prateek Ukumnal', 'At19Vol013', '9035625646', 200.0, 150.0, 50.0, 'prateekukumnal@gmail.com', 'Public Relations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Riya Jain', 'At19Vol014', '9031209340', 200.0, 150.0, 50.0, 'riyajain@gmail.com', 'Public Relations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Riddhi Jain', 'At19Vol015', '9035767740', 200.0, 150.0, 50.0, 'riddhijain@gmail.com', 'Public Relations', 'Aatmatrisha 2019');

 

INSERT INTO VOLUNTEER VALUES('Ashwini Joshi', 'At19Vol016', '9120767740', 200.0, 150.0, 50.0, 'ashwinijoshi@gmail.com', 'Logistics', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Amarnath ', 'At19Vol017', '9120712340', 200.0, 150.0, 50.0, 'amarnath@gmail.com', 'Logistics', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Pratap Jain', 'At19Vol018', '9120767908', 200.0, 150.0, 50.0, 'pratapjain@gmail.com', 'Logistics', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Snehal Chawla', 'At19Vol019', '9145267740', 200.0, 150.0, 50.0, 'snehalchawla@gmail.com', 'Logistics', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Juhi kumari', 'At19Vol020', '9129767740', 200.0, 150.0, 50.0, 'juhikumari@gmail.com', 'Logistics', 'Aatmatrisha 2019');

 

 

INSERT INTO VOLUNTEER VALUES('Chinmay Kulkarni', 'At19Vol021', '9121227740', 200.0, 150.0, 50.0, 'chinmaykulkarni@gmail.com', 'Registrations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Sejal Vanigota', 'At19Vol022', '9123427740', 200.0, 150.0, 50.0, 'sejalvanigota@gmail.com', 'Registrations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Sunil Biradar', 'At19Vol023', '9121677740', 200.0, 150.0, 50.0, 'sunilbiradar@gmail.com', 'Registrations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Anant Patil', 'At19Vol024', '9121127740', 200.0, 150.0, 50.0, 'anantpatil@gmail.com', 'Registrations', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Ashok Kolar', 'At19Vol025', '9123527740', 200.0, 150.0, 50.0, 'ashokkolar@gmail.com', 'Registrations', 'Aatmatrisha 2019');

 

 

INSERT INTO VOLUNTEER VALUES('Vinayak Kulkarni', 'At19Vol026', '9128937740', 200.0, 150.0, 50.0, 'vinayakkulkarni@gmail.com', 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Suresh Gani', 'At19Vol027', '9128931640', 200.0, 150.0, 50.0, 'sureshgani@gmail.com', 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Kumar Sudhakar', 'At19Vol028', '9129037740', 200.0, 150.0, 50.0, 'kumarsudhakar@gmail.com', 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Surveen Chawla', 'At19Vol029', '9139937740', 200.0, 150.0, 50.0, 'surveen@gmail.com', 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Akshay Kumar', 'At19Vol030', '9121137740', 200.0, 150.0, 50.0, 'akshaykumar@gmail.com', 'Campaigning', 'Aatmatrisha 2019');

-------------------------

INSERT INTO VOLUNTEER VALUES('Nand Kishor', 'At19Vol031', '9923527740', 200.0, 150.0, 50.0, 'nandkishor@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Kaveri Kumar', 'At19Vol032', '9993527740', 200.0, 150.0, 50.0, 'kaverikumar@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Aravind Kolar', 'At19Vol033', '9823527740', 200.0, 150.0, 50.0, 'aravind@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Snehal Jain', 'At19Vol034', '9127527740', 200.0, 150.0, 50.0, 'snehal@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Parth Vanigota', 'At19Vol035', '9543527740', 200.0, 150.0, 50.0, 'parth@gmail.com', null, 'Aatmatrisha 2019');

 

INSERT INTO VOLUNTEER VALUES('Bhoomi Kabadi', 'At19Vol036', '9123527741', 200.0, 150.0, 50.0, 'bhoomi@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Shobha Kumari', 'At19Vol037', '9123527742', 200.0, 150.0, 50.0, 'shobha@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Sunny Jain', 'At19Vol038', '9123527743', 200.0, 150.0, 50.0, 'sunnyjain@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Anupamma', 'At19Vol039', '9123527744', 200.0, 150.0, 50.0, 'anupamma@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Satish', 'At19Vol040', '9123527745', 200.0, 150.0, 50.0, 'satish@gmail.com', null, 'Aatmatrisha 2019');

 

INSERT INTO VOLUNTEER VALUES('Sunanda Khote', 'At19Vol041', '9123527746', 200.0, 150.0, 50.0, 'sunanda@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Rajani Shrivastav', 'At19Vol042', '9123527747', 200.0, 150.0, 50.0, 'rajani@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Ananya Pandey', 'At19Vol043', '9123527748', 200.0, 150.0, 50.0, 'ananya@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('I M Khare', 'At19Vol044', '9123527749', 200.0, 150.0, 50.0, 'khare@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Daya Gada', 'At19Vol045', '9123527751', 200.0, 150.0, 50.0, 'dayagada@gmail.com', null, 'Aatmatrisha 2019');

 

INSERT INTO VOLUNTEER VALUES('Alia Khote', 'At19Vol046', '9123527716', 200.0, 150.0, 50.0, 'alia@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Aasmi Shrivastav', 'At19Vol047', '9123527247', 200.0, 150.0, 50.0, 'aasmik@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Shabana Pandey', 'At19Vol048', '9123327748', 200.0, 150.0, 50.0, 'shabana@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Prateek Khare', 'At19Vol049', '9123547749', 200.0, 150.0, 50.0, 'prateekk@gmail.com', null, 'Aatmatrisha 2019');

INSERT INTO VOLUNTEER VALUES('Godavari Gada', 'At19Vol050', '9126527751', 200.0, 150.0, 50.0, 'godavarigada@gmail.com', null, 'Aatmatrisha 2019');

 

/*

                Registrations VOLUNTEERS FOR ALL THE EVENTS

*/

/*

                FOOD AND CATERING FOR ALL THE EVENTS

*/

 

 

INSERT INTO WORKS_FOR VALUES('Concert', 'At19Vol031');

INSERT INTO WORKS_FOR VALUES('Concert', 'At19Vol032');

INSERT INTO WORKS_FOR VALUES('Concert', 'At19Vol033');

INSERT INTO WORKS_FOR VALUES('Concert', 'At19Vol034');

INSERT INTO WORKS_FOR VALUES('Concert', 'At19Vol035');

 

INSERT INTO WORKS_FOR VALUES('Dot Slash', 'At19Vol036');

INSERT INTO WORKS_FOR VALUES('Dot Slash', 'At19Vol037');

INSERT INTO WORKS_FOR VALUES('Dot Slash', 'At19Vol038');

INSERT INTO WORKS_FOR VALUES('Dot Slash', 'At19Vol039');

INSERT INTO WORKS_FOR VALUES('Dot Slash', 'At19Vol040');

 

INSERT INTO WORKS_FOR VALUES('Drama', 'At19Vol041');

INSERT INTO WORKS_FOR VALUES('Drama', 'At19Vol042');

INSERT INTO WORKS_FOR VALUES('Drama', 'At19Vol043');

INSERT INTO WORKS_FOR VALUES('Drama', 'At19Vol044');

INSERT INTO WORKS_FOR VALUES('Drama', 'At19Vol045');

 

INSERT INTO WORKS_FOR VALUES('Fashion Show', 'At19Vol046');

INSERT INTO WORKS_FOR VALUES('Fashion Show', 'At19Vol047');

INSERT INTO WORKS_FOR VALUES('Fashion Show', 'At19Vol048');

INSERT INTO WORKS_FOR VALUES('Fashion Show', 'At19Vol049');

INSERT INTO WORKS_FOR VALUES('Fashion Show', 'At19Vol050');

 

 

 

 

 

INSERT INTO TASK VALUES('At19T00001', 'Meeting', 'Decide the singer', 'COMPLETE', '2019-02-02', 'BG08', 'Concert', null, null);

INSERT INTO TASK VALUES('At19T00002', 'Meeting', 'DotSlash(Venue,Prize amount)', 'COMPLETE', '2019-02-05', 'BG07', 'Dot Slash', null, null);

INSERT INTO TASK VALUES('At19T00003', 'Meeting', 'Drama(Theme,Venue,prize amount)', 'COMPLETE', '2019-02-07', 'BG02', 'Drama', null, null);

INSERT INTO TASK VALUES('At19T00004', 'Meeting F&C', 'Stalls-(Teams, Ideas, budget)', 'PENDING', '2019-02-10', 'BG07', null, 'Food and Catering', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00005', 'College Visit', 'Registerations and Campaigning', 'COMPLETE', '2019-02-05', 'Dayanand Sagar College', null, 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00006', 'College Visit', 'Registerations and Campaigning', 'PENDING', '2019-02-12', 'BMS College', null, 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00007', 'Public Relations', 'In-Campus Campaigning', 'ONGOING', '2019-02-13', 'Caampus', null, 'Public Relations', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00008', 'Meeting DISCO', 'Discipline Measures', 'COMPLETE', '2019-02-09', 'BG07', null, 'DISCO', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00009', 'Registrations', 'Registrations-All events', 'ONGOING', '2019-02-02', 'B-Block Entrance', null, 'Registrations', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00010', 'Meeting', 'Fashion Show Theme', 'PENDING', '2019-02-21', 'BG03', 'Fashion Show', null, null);

INSERT INTO TASK VALUES('At19T00011', 'College Visit', 'Registerations and Campaigning', 'COMPLETE', '2019-02-05', 'R V College', null, 'Campaigning', 'Aatmatrisha 2019');

INSERT INTO TASK VALUES('At19T00012', 'College Visit', 'Registerations and Campaigning', 'PENDING', '2019-02-12', 'Christ', null, 'Campaigning', 'Aatmatrisha 2019');

 

 

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol031', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol032', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol033', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol034', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol035', 'At19T00003');

 

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol036', 'At19T00002');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol037', 'At19T00002');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol038', 'At19T00002');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol039', 'At19T00002');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol040', 'At19T00002');

 

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol041', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol042', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol043', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol044', 'At19T00003');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol045', 'At19T00003');

 

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol001', 'At19T00004');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol002', 'At19T00004');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol003', 'At19T00004');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol004', 'At19T00004');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol005', 'At19T00004');

 

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol011', 'At19T00007');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol012', 'At19T00007');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol013', 'At19T00007');

INSERT INTO PEOPLE_INVOLVED VALUES('At19Vol014', 'At19T00007');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol015', 'At19T00007');

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol006', 'At19T00008');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol007', 'At19T00008');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol008', 'At19T00008');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol009', 'At19T00008');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol010', 'At19T00008');

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol021', 'At19T00009');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol022', 'At19T00009');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol023', 'At19T00009');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol024', 'At19T00009');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol025', 'At19T00009');

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol046','At19T00010');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol047','At19T00010');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol048','At19T00010');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol049','At19T00010');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol050','At19T00010');

 

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol026','At19T00011');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol027','At19T00011');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol028','At19T00011');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol024','At19T00011');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol025','At19T00011');

 

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol029','At19T00012');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol030','At19T00012');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol021','At19T00012');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol022','At19T00012');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol023','At19T00012');

 

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol026','At19T00005');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol027','At19T00005');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol028','At19T00005');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol024','At19T00005');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol025','At19T00006');

 

 

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol029','At19T00006');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol030','At19T00006');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol021','At19T00006');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol022','At19T00006');

INSERT INTO PEOPLE_INVOLVED VALUES( 'At19Vol023','At19T00006');

 

INSERT into PARTICIPANTS VALUES('Ravi Kumar', 'ravikumar@gmail.com', 'At19P00001', '9879675645');

INSERT into PARTICIPANTS VALUES('Ranjan Shevade', 'ranjan@gmail.com', 'At19P00002', '9879675641');

INSERT into PARTICIPANTS VALUES('Hari Gaur', 'harigaur@gmail.com', 'At19P00003', '9879675642');

INSERT into PARTICIPANTS VALUES('Govind Panda', 'govind@gmail.com', 'At19P00004', '9879675643');

INSERT into PARTICIPANTS VALUES('Ragunath Bhattacharya', 'raghunath@gmail.com', 'At19P00005', '9879675644');

INSERT into PARTICIPANTS VALUES('Santosh', 'santosh@gmail.com', 'At19P00006', '9879675645');

INSERT into PARTICIPANTS VALUES('Chandra', 'Chandra@gmail.com', 'At19P00007', '9879675646');

INSERT into PARTICIPANTS VALUES('Kajal', 'kajal@gmail.com', 'At19P00008', '9879675647');

INSERT into PARTICIPANTS VALUES('Raman', 'raman@gmail.com', 'At19P00009', '9879675648');

INSERT into PARTICIPANTS VALUES('Kavi', 'kavi@gmail.com', 'At19P00010', '9879675649');

INSERT into PARTICIPANTS VALUES('Vinod', 'vinod@gmail.com', 'At19P00011', '9879675640');

INSERT into PARTICIPANTS VALUES('Shashikala', 'shashikala@gmail.com', 'At19P00012', '9879675615');

INSERT into PARTICIPANTS VALUES('Sushila', 'sushila@gmail.com', 'At19P00013', '9879675625');

INSERT into PARTICIPANTS VALUES('Rishu', 'rishu@gmail.com', 'At19P00014', '9879675635');

INSERT into PARTICIPANTS VALUES('Prashant', 'prashant@gmail.com', 'At19P00015', '9879675645');

INSERT into PARTICIPANTS VALUES('Pavan', 'pavan@gmail.com', 'At19P00016', '9879675655');

INSERT into PARTICIPANTS VALUES('Ritik', 'ritik@gmail.com', 'At19P00017', '9879675665');

INSERT into PARTICIPANTS VALUES('Ritika', 'ritika@gmail.com', 'At19P00018', '9879675675');

INSERT into PARTICIPANTS VALUES('Rani', 'rani@gmail.com', 'At19P00019', '9879675685');

INSERT into PARTICIPANTS VALUES('Ishita', 'ishita@gmail.com', 'At19P00020', '9879675695');

INSERT into PARTICIPANTS VALUES('Ishika', 'ishika@gmail.com', 'At19P00021', '9879675605');

INSERT into PARTICIPANTS VALUES('Ishani', 'ishani@gmail.com', 'At19P00022', '9879675145');

INSERT into PARTICIPANTS VALUES('Anu', 'anu@gmail.com', 'At19P00023', '9879675245');

INSERT into PARTICIPANTS VALUES('Aruna', 'aruna@gmail.com', 'At19P00024', '9879675345');

INSERT into PARTICIPANTS VALUES('Akhil', 'akhil@gmail.com', 'At19P00025', '9879675445');

INSERT into PARTICIPANTS VALUES('Arpita', 'arpita@gmail.com', 'At19P00026', '9879675545');

INSERT into PARTICIPANTS VALUES('Aasmi', 'aasmi@gmail.com', 'At19P00027', '9879675645');

INSERT into PARTICIPANTS VALUES('Snigdha', 'snigdha@gmail.com', 'At19P00028', '9879675745');

INSERT into PARTICIPANTS VALUES('Vayu', 'vayu@gmail.com', 'At19P00029', '9879675845');

INSERT into PARTICIPANTS VALUES('Mahamai', 'mahamai@gmail.com', 'At19P00030', '9879675945');

INSERT into PARTICIPANTS VALUES('Durgautti', 'durgautti@gmail.com', 'At19P00031', '9879675045');

INSERT into PARTICIPANTS VALUES('Bhumika', 'bhumika@gmail.com', 'At19P00032', '9879671645');

INSERT into PARTICIPANTS VALUES('Amandara', 'amandara@gmail.com', 'At19P00033', '9879672645');

INSERT into PARTICIPANTS VALUES('Kunti', 'kunti@gmail.com', 'At19P00034', '9879673645');

INSERT into PARTICIPANTS VALUES('Satya', 'satya@gmail.com', 'At19P00035', '9879674645');

INSERT into PARTICIPANTS VALUES('Sarita', 'sarita@gmail.com', 'At19P00036', '9879675645');

INSERT into PARTICIPANTS VALUES('Samarj', 'samarj@gmail.com', 'At19P00037', '9879676645');

INSERT into PARTICIPANTS VALUES('Lasya', 'lasya@gmail.com', 'At19P00038', '9879677645');

INSERT into PARTICIPANTS VALUES('Neha', 'neha@gmail.com', 'At19P00039', '9879678645');

INSERT into PARTICIPANTS VALUES('Anushka', 'anushka@gmail.com', 'At19P00040', '9879679645');

INSERT into PARTICIPANTS VALUES('Natasha', 'natasha@gmail.com', 'At19P00041', '9879670645');

 

INSERT INTO PARTICIPATES_IN VALUES('At19P00001', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00002', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00003', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00004', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00005', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00006', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00007', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00008', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00009', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00010', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00011', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00012', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00013', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00014', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00015', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00016', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00017', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00018', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00019', 'Concert');

INSERT INTO PARTICIPATES_IN VALUES('At19P00020', 'Concert');

               

                /*Take care of the teams*/

 

INSERT INTO PARTICIPATES_IN VALUES('At19P00021', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00022', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00023', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00024', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00025', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00026', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00027', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00028', 'Dot Slash');

INSERT INTO PARTICIPATES_IN VALUES('At19P00029', 'Dot Slash');

 

INSERT INTO PARTICIPATES_IN VALUES('At19P00008', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00016', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00024', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00036', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00040', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00010', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00015', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00009', 'Fashion Show');

INSERT INTO PARTICIPATES_IN VALUES('At19P00002', 'Fashion Show');

 

 

 

INSERT INTO PARTICIPATES_IN VALUES('At19P00031', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00032', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00033', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00034', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00035', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00036', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00037', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00038', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00039', 'Dance Battle');

INSERT INTO PARTICIPATES_IN VALUES('At19P00040', 'Dance Battle');

 

 

INSERT INTO CLASS VALUES('10:45:00', '04-03-2019', 'UE17CS251', 'At19Vol001');

INSERT INTO CLASS VALUES('01:30:00', '05-03-2019', 'UE17CS252', 'At19Vol003');

INSERT INTO CLASS VALUES('10:45:00', '04-03-2019', 'UE17CS151', 'At19Vol006');

INSERT INTO CLASS VALUES('11:45:00', '04-03-2019', 'UE17CS251', 'At19Vol030');

INSERT INTO CLASS VALUES('01:30:00', '04-03-2019', 'UE17CS253', 'At19Vol024');

INSERT INTO CLASS VALUES('08:15:00', '06-03-2019', 'UE17CS151', 'At19Vol001');

INSERT INTO CLASS VALUES('10:45:00', '04-03-2019', 'UE17CS351', 'At19Vol001');

INSERT INTO CLASS VALUES('09:15:00', '04-03-2019', 'UE17CS255', 'At19Vol001');

INSERT INTO CLASS VALUES('11:45:00', '04-03-2019', 'UE17CS153', 'At19Vol005');

INSERT INTO CLASS VALUES('01:30:00', '04-03-2019', 'UE17CS254', 'At19Vol015');

INSERT INTO CLASS VALUES('02:30:00', '04-03-2019', 'UE17CS153', 'At19Vol026');

INSERT INTO CLASS VALUES('11:45:00', '04-03-2019', 'UE17CS154', 'At19Vol006');

 

INSERT INTO WINNER VALUES('First', 3000.0, 'Dot Slash', 'At19P00025');

INSERT INTO WINNER VALUES('Second', 2000.0, 'Dot Slash', 'At19P00022');

INSERT INTO WINNER VALUES('Third', 1000.0, 'Dot Slash', 'At19P00027');

 

INSERT INTO WINNER VALUES('First', 500.0, 'Fashion Show', 'At19P00008');

INSERT INTO WINNER VALUES('Second', 500.0, 'Fashion Show', 'At19P00040');

INSERT INTO WINNER VALUES('Third', 500.0, 'Fashion Show', 'At19P00036');

 

 

 

--EPSILON





INSERT INTO FEST VALUES('EPSILON','MRS. Lata','Utkarsh','9675234367','2019-03-23','2019-03-26','F405');

INSERT INTO BUDGET VALUES(11000,'FC01',4000,7000),(11000,'DI01',4000,7000),(11000,'PR01',4000,7000),(11000,'LG01',4000,7000),
(11000,'RG01',4000,7000),(11000,'CP01',4000,7000);

INSERT INTO BUDGET VALUES(11000,'QZ01',4000,7000),(11000,'OR01',4000,7000),(11000,'TH01',4000,7000),(11000,'SC01',4000,7000),
(11000,'DB01',4000,7000),(11000,'RM01',4000,7000);

INSERT INTO EVENT VALUES('9:00:00','2019-03-23','Quiz','B-block','Govind','O0001','9876543210','govind@pes.exu','QZ01','EPSILON'),
('10:00:00','2019-03-23','Obstacle Race','Football Ground','Mansi','O0002','9876543201','mansi@pes.edu','OR01','EPSILON'),
('12:00:00','2019-03-23','Treasure Hunt','G-block','Manav','O0003','9876543401','manav@pes.edu','TH01','EPSILON'),
('10:30:00','2019-03-23','Science Exibition','Student-lounge','Lalit','O0004','9834543401','lalit@pes.edu','SC01','EPSILON'),
('15:00:00','2019-03-23','Debate','G-block','Soumya','O0005','8976543401','soumya@pes.edu','DB01','EPSILON'),
('14:00:00','2019-03-23','Robo-Making','B-Block','Meghna','O0006','9056543401','meghna@pes.edu','RM01','EPSILON');

INSERT INTO DOMAINS VALUES('Food and Catering','Mohan','O0007','9876543210','mohan@pes.edu','EPSILON','FC01'),
('DISCO','Ram','O0008','9876543012','ram@pes.edu','EPSILON','DI01'),
('Public Relations','Akanksha','O0009','9786583071','akanksha@pes.edu','EPSILON','PR01'),
('Logistics','Rachana','O0010','9876542130','rachana@pes.edu','EPSILON','LG01'),
('Registrations','Vivek','O0011','9765432107','vivek@pes.edu','EPSILON','RG01'),
('Campaigning','Sunil','O0012','9876543012','sunil@pes.edu','EPSILON','CP01');

INSERT INTO VOLUNTEER VALUES('Mahesh','V0001',9765434500,1000,0,1000,'mahesh@pes.edu','Food and Catering','EPSILON');
INSERT INTO VOLUNTEER VALUES('Rajesh','V0002',9876345210,1000,0,1000,'rajesh@pes.edu','Food and Catering','EPSILON');
INSERT INTO VOLUNTEER VALUES('Venkatesh','V0003',9234543210,1000,0,1000,'venkatesh@pes.edu','Food and Catering','EPSILON');
INSERT INTO VOLUNTEER VALUES('Priyanka','V0004',9876458710,1000,0,1000,'priyanka@pes.edu','Food and Catering','EPSILON');
INSERT INTO VOLUNTEER VALUES('Suresh','V0005',9876512340,1000,0,1000,'suresh@pes.edu','DISCO','EPSILON');
INSERT INTO VOLUNTEER VALUES('Soumith','V0006',9876234510,1000,0,1000,'soumith@pes.edu','DISCO','EPSILON');
INSERT INTO VOLUNTEER VALUES('Saniya','V0007',9876598540,1000,0,1000,'saniya@pes.edu','DISCO','EPSILON');
INSERT INTO VOLUNTEER VALUES('Aishwarya','V0008',9873456210,1000,0,1000,'aishwaya@pes.edu','DISCO','EPSILON');
INSERT INTO VOLUNTEER VALUES('Supriya','V0009',9876543230,1000,0,1000,'supriya@pes.edu','Public Relations','EPSILON');
INSERT INTO VOLUNTEER VALUES('Soundarya','V0010',9876522100,1000,0,1000,'soundarya@pes.edu','Public Relations','EPSILON');
INSERT INTO VOLUNTEER VALUES('Rohit','V0011',9876543333,1000,0,1000,'rohit@pes.edu','Public Relations','EPSILON');
INSERT INTO VOLUNTEER VALUES('Siddharamesh','V0012',9456543210,1000,0,1000,'siddu@pes.edu','Registrations','EPSILON');
INSERT INTO VOLUNTEER VALUES('Aniket','V0013',9876345108,1000,0,1000,'aniket@pes.edu','Registrations','EPSILON');
INSERT INTO VOLUNTEER VALUES('Athira','V0014',9876234107,1000,0,1000,'athira@pes.edu','Registrations','EPSILON');
INSERT INTO VOLUNTEER VALUES('Nagesh','V0015',9876233210,1000,0,1000,'nagesh@pes.edu','Campaigning','EPSILON');
INSERT INTO VOLUNTEER VALUES('Akash','V0016',9876444410,1000,0,1000,'akash@pes.edu','Campaigning','EPSILON');
INSERT INTO VOLUNTEER VALUES('Rishi','V0017',9823443210,1000,0,1000,'rishi@pes.edu','Campaigning','EPSILON');
INSERT INTO VOLUNTEER VALUES('Omkar','V0018',9876000100,1000,0,1000,'omkar@pes.edu','Campaigning','EPSILON');
INSERT INTO VOLUNTEER VALUES('Sriguru','V0019',9876111110,1000,0,1000,'sriguru@pes.edu','Logistics','EPSILON');
INSERT INTO VOLUNTEER VALUES('Nidhi','V0020',9876523408,1000,0,1000,'nidhi@pes.edu','Logistics','EPSILON');
INSERT INTO VOLUNTEER VALUES('Aarna','V0021',9876888810,1000,0,1000,'aarna@pes.edu','Logistics','EPSILON');
INSERT INTO VOLUNTEER VALUES('Aatmaja','V0022',9876533310,1000,0,1000,'aatmaja@pes.edu','Logistics','EPSILON');
INSERT INTO VOLUNTEER VALUES('Olivia','V0023',9876543450,1000,0,1000,'olivia@pes.edu',NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('Ruby','V0024',9876541110,1000,0,1000,'ruby@pes.edu',NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('Mary','V0025',9876542220,1000,0,1000,'mary@pes.edu',NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('Abhishek','V0026',9873333210,1000,0,1000,'abhishek@pes.edu',NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('Daisy','V0027',9876544440,1000,0,1000,'daisy@pes.edu',NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('Nagesh','V0028',9855543210,1000,0,1000,'tnagesh@pes.edu',NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('freya', 'V0029', 9874443210,1000,0,1000, 'freya@gmail.com', NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('abigail', 'V0030', 9877743210,1000,0,1000, 'abigail@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('poppy', 'V0031', 9878883210,1000,0,1000, 'poppy@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('molly', 'V0032', 9876000210,1000,0,1000, 'molly@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('holly', 'V0033', 9876999210,1000,0,1000, 'holly@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('kirti', 'V0034', 9876512310,1000,0,1000, 'kirti@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('sayed', 'V0035', 9876000210,1000,0,1000, 'sayed@gmail.com', NULL,'EPSILON');
  INSERT INTO VOLUNTEER VALUES('venkatesh', 'V0036', 9874443210,1000,0,1000, 'venkatesh@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('mohit', 'V0037', 9876544410,1000,0,1000, 'mohit@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('supriya', 'V0038', 9876544410,1000,0,1000, 'supriya@gmail.com', NULL,'EPSILON'); 
INSERT INTO VOLUNTEER VALUES('vanij', 'V0039', 9876543444,1000,0,1000, 'vanij@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('sumith', 'V0040', 9876511280,1000,0,1000, 'sumith@gmail.com', NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('megha', 'V0041', 9876543440,1000,0,1000, 'megha@gmail.com', NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('mohan ', 'V0042', 9765412310,1000,0,1000, 'mohan @gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('lalit', 'V0043', 9876543330,1000,0,1000, 'lalit@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('saahil', 'V0044', 9876234210,1000,0,1000, 'saahil@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('yash', 'V0045', 9876533330,1000,0,1000, 'yash@gmail.com', NULL,'EPSILON');
  INSERT INTO VOLUNTEER VALUES('lilly', 'V0046', 9876543444,1000,0,1000, 'lilly@gmail.com', NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('isabel', 'V0047', 9876534310,1000,0,1000, 'isabel@gmail.com', NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES('leah', 'V0048', 9876545610,1000,0,1000, 'leah@gmail.com', NULL,'EPSILON');
INSERT INTO VOLUNTEER VALUES ('aara', 'V0049', 9876542320,1000,0,1000, 'aara@gmail.com', NULL,'EPSILON');
 INSERT INTO VOLUNTEER VALUES('nocole', 'V0050', 9876521310,1000,0,1000, 'nocole@gmail.com', NULL,'EPSILON'); 
INSERT INTO VOLUNTEER VALUES('sofia', 'V0051', 9876543450,1000,0,1000, 'sofia@gmail.com', NULL,'EPSILON');


INSERT INTO PARTICIPANTS VALUES('Sureka','sureka@gmail.com','QZ01P01','9876755371'),
('Madhav','madhav@gmail.com','QZ01P02','9876734371'),
('krishna','krishna@gmail.com','QZ01P03','9876766371'),
('Ritwik','rithwik@gmail.com','QZ01P04','9876555371'),
('Rama','rama@gmail.com','QZ01P05','9876755375'),
('Surendra','surendra@gmail.com','QZ01P06','9875675371'),
('Riya','riya@gmail.com','QZ01P07','9986755371'),
('Rekha','rekha@gmail.com','QZ01P08','9066755371'),
('Vani','vani@gmail.com','QZ01P09','9887655371'),
('Sonu','sonu@gmail.com','RM01P01','9878675371'),
('Sahitya','sahitya@gmail.com','RM01P02','9812345371'),
('Akhilesh','akhilesh@gmail.com','RM01P11','9878985371')
,('Prakash','prakash@gmail.com','RM01P03','9885765371')
,('Prabhu','prabhu@gmail.com','RM01P04','9878965771'),
('Ujwala','ujwala@gmail.com','RM01P05','9878923471'),
('Anita','anita@gmail.com','RM01P06','9878958971'),
('Shilpa','shilpa@gmail.com','RM01P07','9873434371'),
('Urmila','urmila@gmail.com','RM01P08','9876785371'),
('Sahana','sahana@gmail.com','RM01P09','9879807371'),
('Mukesh','mukesh@gmail.com','TH01P01','9879897398'),
('Kavya','kavya@gmail.com','TH01P02','9879985698'),
('Rajesh','rajesh@gmail.com','TH01P03','9834807398'),
('Kavi','kavi@gmail.com','TH01P04','9879805678'),
('Vedant','vedant@gmail.com','TH01P05','9823507398'),
('Druv','druv@gmail.com','TH01P06','9879123698'),
('Sridevi','sridevi@gmail.com','TH01P07','9567807398'),
('Apoorva','apporva@gmail.com','TH01P08','9872367398'),
('Veera','veera@gmail.com','TH01P09','9879898698'),
('Mayank','mayank@gmail.com','OR01P011','9879823498'),
('Saarang','saarang@gmail.com','OR01P01','9879856498'),
('Ravindra','ravindra@gmail.com','OR01P02','9878923498'),
('Virat','virat@gmail.com','OR01P03','9879823456'),
('Rahul','rahul@gmail.com','OR01P04','9879823788'),
('Pranav','Pranav@gmail.com','OR01P05','9879888898'),
('Sooraj','sooraj@gmail.com','OR01P06','987997698'),
('Vishal','radcliff@gmail.com','OR01P07','9867823498'),
('Rohini','radliff@gmail.com','OR01P08','9875783498'),
('Radcliff','radcliff@gmail.com','OR01P09','9769443483'),
('Rudolf','rudolf@gmail.com','OR01P10','9876663498'),
('Sakshi','sakshif@gmail.com','DB01P01','9866663448'),
('Yamini','yaminilf@gmail.com','DB01P02','9877773498'),
('Rihania','rihanalf@gmail.com','DB01P03','9899963498'),
('Sundar','sundarf@gmail.com','DB01P04','9876663498'),
('Jaspreet','jaspreetf@gmail.com','DB01P05','9555563498'),
('Kartik','kartikf@gmail.com','DB01P06','9873333498'),
('Oswald','oswaldf@gmail.com','DB01P07','9874333498'),
('Henry','rhenryf@gmail.com','DB01P08','9875543498'),
('Charan','charanf@gmail.com','DB01P09','9875563498'),
('Mahesh','mahesh@gmail.com','DB01P10','9875563498'),
('Sharath','sharath@gmail.com','SC01P01','9875563498'),
('Kavi','kavi@gmail.com','SC01P02','9875563498'),
('suresh','suresh@gmail.com','SC01P03','9875563498'),
('Venkatesh','venkatesh@gmail.com','SC01P04','9875563498'),
('Kriti','kriti@gmail.com','SC01P05','9875563498'),
('Marg','kmarg@gmail.com','SC01P06','9875563498'),
('parag','parag@gmail.com','SC01P07','9875563498'),
('Soumith','soumith@gmail.com','SC01P08','9875563498'),
('pushpendra','pushpendra@gmail.com','SC01P09','9875563498'),
('Bhavana','bhavana@gmail.com','SC01P10','9875563498');





INSERT INTO WORKS_FOR VALUES('Quiz', 'V0023'), 
('Quiz', 'V0024'), 
('Quiz', 'V0025'), 
('Quiz', 'V0026'), 
('Obstacle Race', 'V0027'), 
('Obstacle Race', 'V0028'), 
('Obstacle Race', 'V0029'),
('Obstacle Race', 'V0030'),
('Obstacle Race', 'V0031'), 
('Debate', 'V0032'), 
('Debate', 'V0033'), ('Debate', 'V0034'),
('Debate', 'V0035'), ('Robo-Making', 'V0036'),
('Robo-Making', 'V0037'), ('Robo-Making', 'V0038'), 
('Robo-Making', 'V0039'), ('Science Exibition', 'V0040'),
('Science Exibition', 'V0041'),
('Science Exibition', 'V0042'),
('Science Exibition', 'V0043'), 
('Treasure Hunt', 'V0044'), ('Treasure Hunt', 'V0045'), 
('Treasure Hunt', 'V0046'), ('Treasure Hunt', 'V0047'),
('Treasure Hunt', 'V0048'), ('Treasure Hunt', 'V0049'), 
('Treasure Hunt', 'V0050'), ('Treasure Hunt', 'V0051');




INSERT INTO WINNER VALUES('first',3000,'Quiz','QZ01P08'),
('Second',1000,'Quiz','QZ01P06'),
('first',3000,'Robo-Making','RM01P11'),
('Second',1000,'Robo-Making','RM01P03'),
('First',3000,'Treasure Hunt','TH01P09'),
('Second',1000,'Treasure Hunt','TH0102'),
('first',3000,'Obstacle Race','OR01P01'),
('Second',1000,'Obstacle Race','OR01P03'),
('first',3000,'Science Exibition','SC01P02'),
('Second',1000,'Science Exibition','SC01P07'),
('first',3000,'Debate','DB01P07'),
('Second',1000,'Debate','DB01P10');


INSERT INTO PARTICIPATES_IN VALUES('QZ01P01','Quiz'),
 ('QZ01P02','Quiz'),
 ('QZ01P03','Quiz'),
 ('QZ01P04','Quiz'),
 ('QZ01P05','Quiz'),
 ('QZ01P06','Quiz'),
 ('QZ01P07','Quiz'),
 ('QZ01P08','Quiz'),
 ('QZ01P09','Quiz'),
('RM01P01','Robo-Making'),
('RM01P02','Robo-Making'),
('RM01P03','Robo-Making'),
('RM01P04','Robo-Making'),
('RM01P05','Robo-Making'),
('RM01P06','Robo-Making'),
('RM01P07','Robo-Making'),
('RM01P08','Robo-Making'),
('RM01P09','Robo-Making'),
('TH01P01','Treasure Hunt'),
('TH01P02','Treasure Hunt'),
('TH01P03','Treasure Hunt'),
('TH01P04','Treasure Hunt'),
('TH01P05','Treasure Hunt'),
('TH01P06','Treasure Hunt'),
('TH01P07','Treasure Hunt'),
('TH01P08','Treasure Hunt'),
('TH01P09','Treasure Hunt'),
('OR01P011','Obstacle Race'),
('OR01P01','Obstacle Race'),
('OR01P02','Obstacle Race'),
('OR01P03','Obstacle Race'),
('OR01P04','Obstacle Race'),
('OR01P05','Obstacle Race'),
('OR01P06','Obstacle Race'),
('OR01P07','Obstacle Race'),
('OR01P08','Obstacle Race'),
('OR01P09','Obstacle Race'),
('OR01P10','Obstacle Race'),
('DB01P01','Debate'),
('DB01P02','Debate'),
('DB01P03','Debate'),
('DB01P04','Debate'),
('DB01P05','Debate'),
('DB01P06','Debate'),
('DB01P07','Debate'),
('DB01P08','Debate'),
('DB01P09','Debate'),
('DB01P10','Debate'),
('SC01P01','Science Exibition'),
('SC01P02','Science Exibition'),
('SC01P03','Science Exibition'),
('SC01P04','Science Exibition'),
('SC01P05','Science Exibition'),
('SC01P06','Science Exibition'),
('SC01P07','Science Exibition'),
('SC01P08','Science Exibition'),
('SC01P09','Science Exibition'),
('SC01P10','Science Exibition');

INSERT INTO CLASS VALUES('10:45:00','2019-03-02','UE17CS','V0001'),
('10:45:00','2019-03-02','UE17CS205','V0002'),
('11:45:00','2019-03-02','UE17CS206','V0003'),
('10:45:00','2019-03-02','UE17CS201','V0004'),
('09:00:00','2019-03-03','UE17CS251','V0005'),
('10:45:00','2019-03-03','UE17CS252','V0006'),
('11:45:00','2019-03-04','UE17CS223','V0007'),
('10:45:00','2019-03-05','UE17CS254','V0008'),
('09:15:00','2019-03-03','UE17CS343','V0009'),
('10:45:00','2019-03-06','UE17CS241','V0010'),
('10:45:00','2019-03-04','UE17CS205','V0011'),
('02:30:00','2019-03-07','UE17CS123','V0012'),
('10:45:00','2019-03-08','UE17CS234','V0013'),
('11:45:00','2019-03-11','UE17CS565','V0014'),
('09:15:00','2019-03-12','UE17CS444','V0015'),
('10:45:00','2019-03-23','UE17CS122','V0016'),
('10:45:00','2019-03-13','UE17CS255','V0017'),
('11:45:00','2019-03-14','UE17CS251','V0018'),
('10:45:00','2019-03-19','UE17CS252','V0019'),
('02:30:00','2019-03-12','UE17CS253','V0020'),
('10:45:00','2019-03-14','UE17CS254','V0021'),
('01:30:00','2019-03-09','UE17CS255','V0022'),
('10:45:00','2019-03-04','UE17CS244','V0023'),
('10:45:00','2019-03-03','UE17CS213','V0024'),
('02:30:00','2019-03-02','UE17CS215','V0025'),
('10:45:00','2019-03-04','UE17CS213','V0026'),
('10:45:00','2019-03-06','UE17CS222','V0027'),
('10:45:00','2019-03-03','UE17CS124','V0028'),
('10:45:00','2019-03-02','UE17CS123','V0029'),
('10:45:00','2019-03-16','UE17CS156','V0030'),
('01:30:00','2019-03-16','UE17CS123','V0031'),
('10:45:00','2019-03-17','UE17CS145','V0032'),
('10:45:00','2019-03-18','UE17CS111','V0033'),
('02:30:00','2019-03-19','UE17CS222','V0034'),
('10:45:00','2019-03-17','UE17CS333','V0035'),
('02:30:00','2019-03-11','UE17CS444','V0036'),
('10:45:00','2019-03-20','UE17CS555','V0037'),
('10:45:00','2019-03-21','UE17CS666','V0038'),
('01:30:00','2019-03-22','UE17CS777','V0039'),
('10:45:00','2019-03-21','UE17CS222','V0040'),
('10:45:00','2019-03-04','UE17CS334','V0041'),
('10:45:00','2019-03-06','UE17CS225','V0042'),
('10:45:00','2019-03-09','UE17CS255','V0043'),
('10:45:00','2019-03-10','UE17CS251','V0044'),
('10:45:00','2019-03-11','UE17CS252','V0045'),
('10:45:00','2019-03-14','UE17CS245','V0046'),
('02:30:00','2019-03-15','UE17CS243','V0047'),
('10:45:00','2019-03-16','UE17CS234','V0048'),
('01:30:00','2019-03-17','UE17CS233','V0049'),
('10:45:00','2019-03-18','UE17CS222','V0050'),
('01:30:00','2019-03-19','UE17CS221','V0051');

INSERT INTO TASK VALUES('T001','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G04','Quiz',NULL,'EPSILON'),
('T002','Meeting','Questionare preparation','PENDING','2019-03-20','G04','Quiz',NULL,'EPSILON'),
('T003','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G06','Debate',NULL,'EPSILON'),
('T004','Meeting','Topic finalisation','PENDING','2019-03-18','G05','Debate',NULL,'EPSILON'),
('T005','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G03',NULL,'Campaigning','EPSILON'),
('T006','Meeting','Cities List finalisation','PENDING','2019-03-16','G08',NULL,'Campaigning','EPSILON'),
('T007','College visit','Registrations Campaigning','PENDING','2019-03-17','BIT College',NULL,'Campaigning','EPSILON'),
('T008','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G05','Treasure Hunt',NULL,'EPSILON'),
('T009','Meeting','Clue finalisation','PENDING','2019-03-15','G05','Treasure Hunt',NULL,'EPSILON'),
('T010','Meeting','Volunteer Orientation','PENDING','2019-03-12','G05','Obstacle Race',NULL,'EPSILON'),
('T011','Meeting','Planning','PENDING','2019-03-21','G04','Obstacle Race',NULL,'EPSILON'),
('T012','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G06','Robo-Making',NULL,'EPSILON'),
('T013','Meeting','Theme discussion','PENDING','2019-03-13','G06','Robo-Making',NULL,'EPSILON'),
('T014','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G03',NULL,'Registrations','EPSILON'),
('T015','Meeting','Registration fee discussion','PENDING','2019-03-16','G08',NULL,'Registrations','EPSILON'),
('T016','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G03',NULL,'Logistics','EPSILON'),
('T017','Meeting','Travel expenses discussion','PENDING','2019-03-18','G08',NULL,'Logistics','EPSILON'),
('T018','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G03',NULL,'Food and Catering','EPSILON'),
('T019','Meeting','Food stall finalisation','PENDING','2019-03-16','G08',NULL,'Food and Catering','EPSILON'),
('T020','Meeting','Volunteer Orientation','COMPLETE','2019-03-12','G03',NULL,'Public Relations','EPSILON'),
('T021','Meeting','Class Room Campaigning','PENDING','2019-03-18','G08',NULL,'Public Relations','EPSILON'),
('T022','College Visit','Registrations and Campaigning','PENDING','2019-03-14','Dayanand Sagar College',NULL,'Campaigning','EPSILON'),
('T023','College Visit','Registrations and Campaigning','PENDING','2019-03-15','BMS College',NULL,'Campaigning','EPSILON'),
('T024','College Visit','Registrations and Campaigning','PENDING','2019-03-16','RV College',NULL,'Campaigning','EPSILON');


INSERT INTO PEOPLE_INVOLVED VALUES
('O0001','T001'), -- Quiz
('V0023','T001'),
('V0024','T001'),
('V0025','T001'),
('V0026','T001'),

('O0001','T002'),-- Quiz
('V0023','T002'),
('V0024','T002'),
('V0025','T002'),

('O0005','T003'),--Debate
('V0032','T003'),
('V0033','T003'),
('V0034','T003'),
('V0035','T003'),

('O0005','T004'),--Debate
('V0032','T004'),
('V0033','T004'),

('O0012','T005'),-- Campaigning
('V0015','T005'),
('V0016','T005'),
('V0017','T005'),
('V0018','T005'),

('O0015','T006'),-- Campaigning
('V0015','T006'),
('V0016','T006'),
('V0017','T006'),
('V0018','T006'),

('O0012','T007'),-- Campaigning
('V0015','T007'),
('V0016','T007'),


('O0012','T022'),-- Campaigning
('V0016','T022'),
('V0017','T022'),


('O0012','T023'),-- Campaigning
('V0018','T023'),
('V0017','T023'),

('O0012','T024'),-- Campaigning
('V0015','T024'),
('V0018','T024'),

('O0003','T008'),--Treasure Hunt
('V0044','T008'),
('V0045','T008'),
('V0046','T008'),
('V0047','T008'),
('V0048','T008'),
('V0049','T008'),
('V0050','T008'),
('V0051','T008'),

('O0003','T009'),--Treasure Hunt
('V0050','T009'),
('V0044','T009'),

('O0002','T010'),--Obstacle Race
('V0027','T010'),
('V0031','T010'),
('V0028','T010'),

('O0002','T011'),
('V0027','T011'),
('V0028','T011'),--Obstacle Race


('O0006','T012'),
('V0036','T012'),
('V0037','T012'),--Robomaking
('V0038','T012'),
('V0039','T012'),

('O0006','T013'),
('V0039','T013'),--Robomaking
('V0037','T013'),

('V0012','T014'),--Registrations
('O0011','T014'),
('V0013','T014'),
('V0014','T014'),

('O0011','T015'),
('V0012','T015'),--Registrations
('V0013','T015'),

('O0007','T016'),--Food and C
('V0001','T016'),
('V0002','T016'),
('V0003','T016'),
('V0004','T016'),


('O0007','T017'),--Food and C
('V0001','T017'),
('V0004','T017'),

('O0010','T017'),--Logistics
('V0019','T017'),
('V0021','T017'),
('V0022','T017'),
('V0020','T017'),

('O0010','T018'),--Logistics
('V0019','T018'),
('V0022','T018'),

('O0009','T019'),--Public R
('V0009','T019'),
('V0010','T019'),
('V0011','T019'),

('O0009','T020'),--Public R
('V0009','T020'),
('V0010','T020');
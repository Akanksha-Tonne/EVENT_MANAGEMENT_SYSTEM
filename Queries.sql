--1Given a volunteer name find the number of classes missed.

--Example

select vid, count(*) from volunteer, class where vname='EmilyBurgess' and vid=vid_fk group by vid;

 

--2LIst out all the classes missed by a volunteer given the name

--Example

select * from class where vid_fk in (select vid from volunteer where vname='EmilyBurgess');

 

--3Given a voluteer name retrieve how much money is spent, due and total

-- Example

select total_amt as TotalAmount, amt_spent as amountspent, amt_due as amountdue from volunteer where vname='EmilyBurgess';

 

--4All volunteers who work for domain of registrations increase their total amount

--by 1000

UPDATE VOLUNTEER SET total_amt=total_amt+1000,amt_due=amt_due+1000 WHERE Vid in (select vid from volunteer where dname_fk_v='Registrations');

 

--5Find the sum of the total money spent by all the volunteer of each domain.

select fname_fk_v,dname_fk_v,sum(total_amt) total_amount from volunteer where dname_fk_v is not null group by dname_fk_v,fname_fk_v order by total_amount;

 

--6Find all the tasks which are pending by the volunteer given a volunteer

SELECT TASK_NAME,PURPOSE FROM TASK WHERE TASK_ID IN(select task_id_fk from people_involved where task_pid =(select vid from volunteer where vname='EmilyBurgess')) AND STATUS='PENDING';

 

--7FIND ALL THE TASKS OF A PARTICULAR DOMAIN.

select task_name,purpose,status from task where task_date<'2019-03-12';

 

--8Find the number of participants in each event;

select count(*),ename_fk from participates_in group by ename_f;

 

--9select all the volunteers who have missed more than 3 classes

select vname from (volunteer join (select vid_fk, count(*) from class group by vid_fk having count(*)>3) as x on vid=vid_fk);

 

 

--10given a name of a participant find all the events in which he participates.

select reg_id, ename_fk, evt_date, start_time from (participants join participates_in on reg_id=reg_id_fk)join event on ename_fk=ename where pname='Ranjan Shevade';

 

--11List all the colleges to be visited along with the volunteers who have to visit them.

select task_venue, count(*) from (people_involved join task on task_id=task_id_fk and task_id in (select task_id from task where task_name = 'College Visit')) group by task_venue;

--12 list all the colleges visited along with the details of the volunteers who visited the college

select task_venue, vname from volunteer join (people_involved join task on task_id=task_id_fk and task_id in (select task_id from task where task_name = 'College Visit')) on task_pid=vid group by task_venue;

 

 

--13Given a college name find all the volunteers visitng that college for Registrations and Campaigning.

-- generic can be any college

select vname from (volunteer join people_involved on task_pid=vid and task_id_fk in (select task_id from task where task_venue = 'BMS College'));

 

--14 list all the participants and the number of events that they are participating in.

select pname, reg_id, count(*) from (participants join participates_in on reg_id=reg_id_fk) group by pnam, reg_d;

 

--15 list all the events, venue and date on which the event is held for a given participant.

--Example pname='Sarita', pname='Rani'

select ename_fk, pname, reg_id, evt_date from ((participant join participates_in on pname='Rani' and reg_id=reg_id_fk) join event on ename_fk=ename);

 


 -- List the names of all the volunteer and their ids who go for campaigning to a college
 select vid,vname from Volunteer  where exists ((select task_id_fk from PEOPLE_INVOLVED where Task_pID=vid) INTERSECT (select task_id from task where task_name='College Visit'));


-- find the amount due remaining for each each budget
select dname,amt_due from domains join budget on budget_id = budget_id_fk;

-- Update the budget of each domain in epsilon incremented by 6000

update budget set total_amt=total_amt+6000,amt_due=amt_due+6000 where budget_id in (select budget_id_fk_domains from domains where fname_fk='EPSILON');

-- List all the organisers names and their contact details of the fest Aatmatrisha 
select dname,dcoord_name,dcoord_phone,dcoord_email from domains where fname_fk='EPSILON';
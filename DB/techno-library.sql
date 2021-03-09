#drop database techno_library;

#------------ BASE DE DATOS ----------------
create database techno_library;
use techno_library;

create table users( 
	ID int primary key auto_increment ,
	name varchar(40), 
	lastName varchar(40), 
	email varchar(30), 
	password varchar(20) 
);

create table user_book (
	FK_user int,
    book int,
    constraint FK_USER_UB foreign key (FK_user) references users(ID),
	constraint PK_UB primary key (FK_user,book)
);

#------------ CONSTRAINT ----------------
alter table users
add constraint uq_user_email unique(email);

#------------ VISTAS ----------------
create view vw_user as
select id as id, name as firstname, lastName as lastname, email as email, password as paswd 
from users;

create view vw_user_list as
select FK_user as id, book
from user_book;

#------------ PROCEDIMIENTOS ALMACENADOS ----------------
#drop procedure sp_insert_user

DELIMITER //
create procedure sp_insert_user (	
	in uFirstname varchar(50),
	in uLastnane varchar(50),
    in uEmail varchar(60),    
    in uPsswd varchar(30),
    out num int
) 
begin

	insert into users (name, lastName, email, password)
    values(uFirstname, uLastnane, uEmail, uPsswd);
    
    set num = (select id from users 
    where name = uFirstname and lastName = uLastnane and email = uEmail and password = uPsswd);
    
end //
DELIMITER ;

#call sp_insert_user ("Luis","Carlos","lcarlo@gmail.com","123456",@num);


DELIMITER //
 create procedure sp_insert_libro 
 (
 in ufkuser int,
 in ubook int
 )
 begin 
 insert into user_book(FK_user,book)
 values(ufkuser,ubook);
 end;
 
 call sp_insert_libro(2,464);


#------------ INSERT ----------------
insert into users(name, lastName, email, password) values
("Denisse","Arreola","arxie.denisse@gmail.com","123456");

insert into user_book(FK_user, book) values
(1,1471),(1,589),(1,853);

#delete from user_book where FK_user = 1 and book = 0;

#------------ SELECT ----------------
select * from vw_user where id=1;
select * from vw_user_list where id=1;
select * from vw_user where email = usern and paswd=passwd
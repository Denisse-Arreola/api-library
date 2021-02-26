#drop database techno_library;

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

create view vw_user as
select id as id, 
name as firstname,
lastName as lastname,
email as email,
password as paswd 
from users;

create view vw_user_list as
select FK_user as id, book
from user_book;

insert into users(name, lastName, email, password) values
("Denisse","Arreola","arxie.denisse@gmail.com","123456");

insert into user_book(FK_user, book) values
(1,1471),(1,589),(1,853);

select * from vw_user where id=1;
select * from vw_user_list where id=1;
select * from vw_user where email = usern and paswd=passwd
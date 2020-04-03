create database assignment1;
use assignment1;
                     
create table attraction(attraction_id int not null auto_increment, primary key(attraction_id),
						country varchar(255) not null,
                        attraction_name varchar(255) not null);
                        
create table review(review_id int not null auto_increment, primary key(review_id), 
					attraction_id int not null, foreign key(attraction_id) references attraction(attraction_id),
				    first_name varchar(255) not null,
                    last_name varchar(255) not null,
                    review varchar(500) not null);
                    
create table image(image_id int not null auto_increment, primary key(image_id),
				   attraction_id int not null, foreign key(attraction_id) references attraction(attraction_id),
				   url varchar(2083) not null,
				   type varchar(255) not null);
                    
create table label(label_id int not null auto_increment, primary key(label_id), 
				   attraction_id int not null, foreign key(attraction_id) references attraction(attraction_id),
                   label_name varchar(255) not null,
                   label varchar(255));

create table account(email varchar(320) not null unique, 
					 password char(60) not null, 
					 first_name varchar(255) not null, 
                     last_name varchar(255) not null, 
                     address varchar(255) not null, 
                     telephone_num varchar(15) not null);

insert into attraction values(1,'Canada','CN Tower');
insert into attraction values(2,'Canada','Banff National Park');
insert into attraction values(3,'United States','Disneyland');
insert into attraction values(4,'United States','Grand Canyon National Park');
insert into attraction values(5,'Russia','State Hermitage Museum');
insert into attraction values(6,'Russia','The Moscow Kremlin');
insert into attraction values(7,'Germany','Neuschwanstein Castle');
insert into attraction values(8,'Germany','Brandenburg Gate');
insert into attraction values(9,'Brazil','Christ the Redeemer');
insert into attraction values(10,'Brazil','Sugarloaf Mountain');
insert into attraction values(11,'Argentina','Perito Moreno Glacier');
insert into attraction values(12,'Argentina','Parque Nacional Los Glaciares');
insert into attraction values(13,'South Africa','Kruger National Park');
insert into attraction values(14,'South Africa','Cape of Good Hope');
insert into attraction values(15,'Egypt','Giza Necropolis');
insert into attraction values(16,'Egypt','Valley of the Kings');
insert into attraction values(17,'China','Great Wall of China');
insert into attraction values(18,'China','Forbidden City');
insert into attraction values(19,'India','Taj Mahal');
insert into attraction values(20,'India','Amber Palace');

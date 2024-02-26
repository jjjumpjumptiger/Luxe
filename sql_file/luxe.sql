/*DROP TABLE product;
DROP TABLE itemincart;
DROP TABLE userinfo;
DROP TABLE orderinfo;
*/
create table product(
productid int unsigned not null auto_increment primary key,
colorid int unsigned,
brandname char(50),
soldvolume int default 0,
sale int unsigned, 
price double not null,
imagelink varchar(2000),
productname varchar(255),
categoryid int unsigned,
quantity int default 0

);



create table itemincart(
cartid int unsigned not null auto_increment primary key,
productid int unsigned not null,
email char(200) not null,
quantity int unsigned,
size char(50)
);

create table userinfo(
userid int unsigned not null auto_increment primary key,
email char(200),
password char(200)
);

create table orderinfo(
orderid int unsigned not null auto_increment primary key,
email char(200) not null,
productid int unsigned not null,
price double not null,
orderdate date,
quantity int unsigned
);



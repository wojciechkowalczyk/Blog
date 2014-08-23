

 drop table if exists blog;
 
 CREATE TABLE blog (
   id int(11) NOT NULL auto_increment,
   author varchar(100) NOT NULL,
   title varchar(100) NOT NULL,
   content text,
   teaser text,

   PRIMARY KEY (id)
 );
 
 
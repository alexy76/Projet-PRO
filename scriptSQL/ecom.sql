#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: ec_users
#------------------------------------------------------------

CREATE TABLE ec_users(
        usr_id                  Int  Auto_increment  NOT NULL ,
        usr_mail                Varchar (200) NOT NULL ,
        usr_password            Varchar (200) NOT NULL ,
        usr_lastname            Varchar (100) NOT NULL ,
        usr_firstname           Varchar (100) NOT NULL ,
        usr_accept_newsletters  Bool NOT NULL ,
        usr_registered          Date NOT NULL ,
        usr_account_activate    Bool NOT NULL ,
        usr_role                Int NOT NULL ,
        usr_token_mail          Varchar (255) ,
        usr_token_password      Varchar (255) ,
        usr_time_validity_token Datetime ,
        usr_adress              Varchar (255) ,
        usr_zip_code            Varchar (10) ,
        usr_city                Varchar (255) ,
        usr_country             Varchar (255)
	,CONSTRAINT ec_users_PK PRIMARY KEY (usr_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_newsletters
#------------------------------------------------------------

CREATE TABLE ec_newsletters(
        id               Int  Auto_increment  NOT NULL ,
        news_adress_mail Varchar (255) NOT NULL
	,CONSTRAINT ec_newsletters_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_category
#------------------------------------------------------------

CREATE TABLE ec_category(
        cat_id   Int  Auto_increment  NOT NULL ,
        cat_name Varchar (100) NOT NULL
	,CONSTRAINT ec_category_PK PRIMARY KEY (cat_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_collection
#------------------------------------------------------------

CREATE TABLE ec_collection(
        col_id               Int  Auto_increment  NOT NULL ,
        col_name             Varchar (100) NOT NULL ,
        col_slug             Varchar (255) ,
        col_content_html     Mediumtext ,
        col_meta_title       Varchar (500) ,
        col_meta_description Varchar (1000) ,
        cat_id               Int NOT NULL
	,CONSTRAINT ec_collection_PK PRIMARY KEY (col_id)

	,CONSTRAINT ec_collection_ec_category_FK FOREIGN KEY (cat_id) REFERENCES ec_category(cat_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_products
#------------------------------------------------------------

CREATE TABLE ec_products(
        pdt_id                Int  Auto_increment  NOT NULL ,
        pdt_title             Varchar (200) NOT NULL ,
        pdt_price             Float NOT NULL ,
        pdt_activated         Bool NOT NULL ,
        pdt_option            Varchar (250) ,
        pdt_discount          Int ,
        pdt_slug              Varchar (200) ,
        pdt_tagname           Varchar (1000) ,
        pdt_short_description Text ,
        pdt_long_description  Text ,
        pdt_meta_title        Varchar (1000) ,
        pdt_meta_description  Varchar (1000) ,
        col_id                Int NOT NULL
	,CONSTRAINT ec_products_PK PRIMARY KEY (pdt_id)

	,CONSTRAINT ec_products_ec_collection_FK FOREIGN KEY (col_id) REFERENCES ec_collection(col_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_images
#------------------------------------------------------------

CREATE TABLE ec_images(
        img_id         Int  Auto_increment  NOT NULL ,
        img_name_file  Varchar (250) NOT NULL ,
        img_ext_file   Varchar (20) NOT NULL ,
        img_label_file Varchar (500) NOT NULL
	,CONSTRAINT ec_images_PK PRIMARY KEY (img_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_comments_products
#------------------------------------------------------------

CREATE TABLE ec_comments_products(
        cmt_id        Int  Auto_increment  NOT NULL ,
        cmt_author    Varchar (100) NOT NULL ,
        cmt_note      Float NOT NULL ,
        cmt_date      Date NOT NULL ,
        cmt_text      Text NOT NULL ,
        cmt_validated Bool NOT NULL ,
        pdt_id        Int NOT NULL
	,CONSTRAINT ec_comments_products_PK PRIMARY KEY (cmt_id)

	,CONSTRAINT ec_comments_products_ec_products_FK FOREIGN KEY (pdt_id) REFERENCES ec_products(pdt_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_get_images
#------------------------------------------------------------

CREATE TABLE ec_get_images(
        img_id Int NOT NULL ,
        pdt_id Int NOT NULL
	,CONSTRAINT ec_get_images_PK PRIMARY KEY (img_id,pdt_id)

	,CONSTRAINT ec_get_images_ec_images_FK FOREIGN KEY (img_id) REFERENCES ec_images(img_id)
	,CONSTRAINT ec_get_images_ec_products0_FK FOREIGN KEY (pdt_id) REFERENCES ec_products(pdt_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ec_commands_clients
#------------------------------------------------------------

CREATE TABLE ec_commands_clients(
        pdt_id       Int NOT NULL ,
        usr_id       Int NOT NULL ,
        cmd_qty      Int NOT NULL ,
        cmd_date     Date NOT NULL ,
        cmd_nb_order Varchar (100) NOT NULL
	,CONSTRAINT ec_commands_clients_PK PRIMARY KEY (pdt_id,usr_id)

	,CONSTRAINT ec_commands_clients_ec_products_FK FOREIGN KEY (pdt_id) REFERENCES ec_products(pdt_id)
	,CONSTRAINT ec_commands_clients_ec_users0_FK FOREIGN KEY (usr_id) REFERENCES ec_users(usr_id)
)ENGINE=InnoDB;
-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Tue Nov 26 10:41:22 2019
-- ********************************************* 


-- Database Section
-- ________________ 

if not exists create database db_printers;
use db_printers;


-- Tables Section
-- _____________ 

create table t_purchase (
     idCustomer int unsigned not null,
     idProduct int unsigned not null,
     purDate date not null,
     purPrice float(1) unsigned not null,
     constraint ID_purchase_ID primary key (idCustomer, idProduct));

create table t_supply (
     idProduct int unsigned not null,
     idSupplier int unsigned not null,
     constraint ID_supply_ID primary key (idSupplier, idProduct));

create table t_brand (
     idBrand int unsigned not null auto_increment,
     braName varchar(50) not null,
     idManufacturer int unsigned not null,
     constraint ID_t_brand_ID primary key (idBrand));

create table t_consumable (
     idConsumable int unsigned not null auto_increment,
     conName varchar(50) not null,
     conPrice float(1) unsigned not null,
     conType varchar(50) not null,
     idBrand int unsigned not null,
     constraint ID_t_consumable_ID primary key (idConsumable));

create table t_customer (
     idCustomer int unsigned not null auto_increment,
     cusFirstName varchar(50) not null,
     cusLastName varchar(50) not null,
     constraint ID_t_customer_ID primary key (idCustomer));

create table t_history (
     idHistory int unsigned not null auto_increment,
     hisDate date not null,
     hisPrice float(1) unsigned not null,
     idProduct int unsigned not null,
     constraint ID_t_history_ID primary key (idHistory));

create table t_manufacturer (
     idManufacturer int unsigned not null auto_increment,
     manName varchar(50) not null,
     constraint ID_t_manufacturer_ID primary key (idManufacturer));

create table t_product (
     idProduct int unsigned not null auto_increment,
     proName varchar(150) not null,
     proPrintSpeedBW float(1) unsigned,
     proPrintSpeedCol float(1) unsigned,
     proPrintResX int unsigned,
     proPrintResY int unsigned,
     proRectoVerso char not null,
     proColour char not null,
     proPrintTech varchar(50) not null,
     proScanSpeedBW float(1) unsigned,
     proScanSpeedCol float(1) unsigned,
     proScanResX int unsigned,
     proScanResY int unsigned,
     proWeight float(1) unsigned,
     proLength float(1) unsigned,
     proHeight float(1) unsigned,
     proWidth float(1) unsigned,
     idBrand int unsigned not null,
     constraint ID_t_product_ID primary key (idProduct));

create table t_supplier (
     idSupplier int unsigned not null auto_increment,
     supName varchar(50) not null,
     constraint ID_t_supplier_ID primary key (idSupplier));

create table t_use (
     idConsumable int unsigned not null,
     idProduct int unsigned not null,
     constraint ID_use_ID primary key (idConsumable, idProduct));


-- Constraints Section
-- ___________________ 

alter table t_purchase add constraint FKpur_t_p_FK
     foreign key (idProduct)
     references t_product (idProduct);

alter table t_purchase add constraint FKpur_t_c
     foreign key (idCustomer)
     references t_customer (idCustomer);

alter table t_supply add constraint FKsup_t_s
     foreign key (idSupplier)
     references t_supplier (idSupplier);

alter table t_supply add constraint FKsup_t_p_FK
     foreign key (idProduct)
     references t_product (idProduct);

-- Not implemented
-- alter table t_brand add constraint ID_t_brand_CHK
--     check(exists(select * from t_product
--                  where t_product.idBrand = idBrand)); 

alter table t_brand add constraint FKbuild_FK
     foreign key (idManufacturer)
     references t_manufacturer (idManufacturer);

alter table t_consumable add constraint FKprovide_FK
     foreign key (idBrand)
     references t_brand (idBrand);

alter table t_history add constraint FKhave_FK
     foreign key (idProduct)
     references t_product (idProduct);

-- Not implemented
-- alter table t_manufacturer add constraint ID_t_manufacturer_CHK
--     check(exists(select * from t_brand
--                  where t_brand.idManufacturer = idManufacturer)); 

-- Not implemented
-- alter table t_product add constraint ID_t_product_CHK
--     check(exists(select * from t_history
--                  where t_history.idProduct = idProduct)); 

-- Not implemented
-- alter table t_product add constraint ID_t_product_CHK
--     check(exists(select * from t_supply
--                  where t_supply.idProduct = idProduct)); 

-- Not implemented
-- alter table t_product add constraint ID_t_product_CHK
--     check(exists(select * from t_use
--                  where t_use.idProduct = idProduct)); 

alter table t_product add constraint FKmarket_FK
     foreign key (idBrand)
     references t_brand (idBrand);

alter table t_use add constraint FKuse_t_p_FK
     foreign key (idProduct)
     references t_product (idProduct);

alter table t_use add constraint FKuse_t_c
     foreign key (idConsumable)
     references t_consumable (idConsumable);


-- Index Section
-- _____________ 

create unique index ID_purchase_IND
     on t_purchase (idCustomer, idProduct);

create index FKpur_t_p_IND
     on t_purchase (idProduct);

create unique index ID_supply_IND
     on t_supply (idSupplier, idProduct);

create index FKsup_t_p_IND
     on t_supply (idProduct);

create unique index ID_t_brand_IND
     on t_brand (idBrand);

create index FKbuild_IND
     on t_brand (idManufacturer);

create unique index ID_t_consumable_IND
     on t_consumable (idConsumable);

create index FKprovide_IND
     on t_consumable (idBrand);

create unique index ID_t_customer_IND
     on t_customer (idCustomer);

create unique index ID_t_history_IND
     on t_history (idHistory);

create index FKhave_IND
     on t_history (idProduct);

create unique index ID_t_manufacturer_IND
     on t_manufacturer (idManufacturer);

create unique index ID_t_product_IND
     on t_product (idProduct);

create index FKmarket_IND
     on t_product (idBrand);

create unique index ID_t_supplier_IND
     on t_supplier (idSupplier);

create unique index ID_use_IND
     on t_use (idConsumable, idProduct);

create index FKuse_t_p_IND
     on t_use (idProduct);


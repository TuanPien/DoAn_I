create table Ho_so_nguoi_mua
(
buyerID varchar (255),
address varchar (255),
point int,
id varchar (255)
)

create table Ho_so_nguoi_ban
(
sellerID varchar(255),
shopAddress varchar(255),
id varchar(255)
)

create table Ho_so_nguoi_quan_ly
(
adminID varchar(255),
job varchar(255),
id varchar(255),
productTypeID varchar(255),
productTypeName varchar(255),
)

create table product_type
(
productTypeID varchar(255),
productTypeName varchar(255)
)

create table product
(
productID varchar(255),
productName varchar(255),
price int,
unit varchar(255),
amountLeft int,
company varchar(255),
purchased int,
productTypeName varchar(255),
sellerID varchar(255),
)

create table cung_cap_boi
(
sellerID varchar(255),
productID varchar(255),
)

create table tham_gia_vao
(
buyerID varchar(255),
campaingnID varchar(255)
)


create table phan_hoi
(
commentID varchar(255),
contentBuyer varchar(255),
rate int,
contentSeller varchar(255),
id varchar(255),
productId varchar(255)
)

create table Ho_so_chien_dich
(
campaingnID varchar(255),
dateStart date,
dateEnd date,
campAmountBuy int,
campPrice int,
discountID varchar(255),
productId varchar(255)
)

create table Ho_so_hoa_don
(
billId varchar(255),
productAmount int,
payDate date,
billPrice int,
payMethod varchar(255),
billCondition varchar(255),
pointPlus int,
campaignID varchar(255),
buyerID varchar(255),
promoID varchar(255),
productID varchar(255)
)

create table Ho_so_khuyen_mai
(
promoID varchar(255),
dateStart date,
dateEnd date,
percentPromo int,
promoCondition int,
sellerID varchar(255)
)

create table Ho_so_chiet_khau
(
discountID varchar(255),
percentDiscount int,
conditionStart int,
conditionEnd int,
sellerID varchar(255)
)



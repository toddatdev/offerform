/*
------------------------------------------------------------------
Provider:  Zip-Codes.com
Product:   U.S. ZIP Code Database Free
------------------------------------------------------------------
This SQL Creates a new table named ZIPCodes,
related indexes, and extended column information.

This script is designed to work with MySQL

Actions:
  1.) Drop Table ZIPCodes if it exists
  2.) Creates Table named ZIPCodes
  3.) Creates Indexes on table ZIPCodes
  4.) Creates Extended Column Information

Last Updated: 07/07/2011
------------------------------------------------------------------
*/


/* 1.) Drop Table if it Exists */
DROP TABLE IF EXISTS zipcodes;



/* 2.) Create Table */
CREATE TABLE zipcodes (
    zipcode char(5) NOT NULL,
	city varchar(35) NULL,
	state char(2),
	latitude decimal(12, 4),
	longitude decimal(12, 4),
	classification varchar(1) NULL,
	population int
);



/* 3.) Create Indexes on most searched fields */
CREATE INDEX Index_zipcodes_ZipCode					 ON zipcodes (zipcode);
CREATE INDEX Index_zipcodes_State					 ON zipcodes (state);
CREATE INDEX Index_zipcodes_City					 ON zipcodes (city);
CREATE INDEX Index_zipcodes_Latitude				 ON zipcodes (latitude);
CREATE INDEX Index_zipcodes_Longitude				 ON zipcodes (longitude);

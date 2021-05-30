# Divante

## Interview Task

### Requirements

- Webserver to serve the files
- PHP 8.0+
- Composer


### Purpose of the application

The application is used to download products data from external suppliers. The data has to be downloaded from 
suppliers and displayed in a table form in the console. The data comes in different formats from different suppliers.
In addition, the supplier information and product ID should be saved to the event log in the disk, the data should be 
logged into one file.

To simplify the task, the response from external providers is simulated by reading files from the "web" directory. 
Access to other directories from the browser level should be blocked.

The command is called through: `php bin/console divante:supplier-sync name_supplier`

### Technical requirements of the task

- Easy to add more suppliers.
- Easy ability to add more data formats.
- Adding the ability to log product information.

### Task

The task is to complete the existing/new structure in such a way that the application meets the description
and technical requirements.
It is possible to modify structures in order to achieve a business result and meet the technical requirements.
It is possible to use further or different libraries than those existing in the structure, which should be added in
`composer.json`

### Solution

I reorganized a bit the structure to work with objects.

- To add new supplier, please follow definition of service from: `config/services.yaml:supplier.supplier_1`
- To add new data format (`.csv, ..`), please follow implementation of `JsonParser`
- To run code from outside of docker container, please edit `$responsePath` variable in `config/services.yaml:supplier.supplier_1` for each supplier
- To see logs please run in container: `cat ./var/log/supplier.log`
# BRCMS   
This is a content management system news site for Bantay Radyo Radio Station.

### Features:    
* Authentication
* CRUD(Create, Read, Update & Delete) functionality:
  * News Article
  * Banner Ads
  * Photo
* Search
* AutoResponder
* Archive management


#### Requirements:    
* Apache2 v2.4     
* PHP v5.5   
* MySQL v5.5   
     
#### Installation:   
1. Change directory to Apache2 DocumentRoot e.g., /var/www/html (for ubuntu v14 or latest) or /htdocs (for windows)
2. Inside the DocumentRoot folder lets execute git clone command   
   e.g, git clone --depth=1 https://github.com/sudogem/brcms.git    
3. Import the database schema(schema.sql) found inside db/ into your phpMyAdmin   
4. Edit the admin/configuration.php file and class_dbsettings.php found inside the /classes folder   
4. Open the app by accessing it in your browser e.g. http://localhost/brcms   

#### Technology stacks:   
* jQuery   
* HTML/CSS   
* PHP   
* MySQL  

#### Developer   
BRCMS &copy; 2011 Arman Ortega. Released under the MIT License.   
# DragonBallGo
This contains web application codes that were used in building my Dragon Ball user vs user application


Infrasture:
2 Fedora  25 Servers. One is a publicly visible web server and the other in a firewalled MariaDB server. 

About the application:
The application is for dragon ball fans and community. It lets users view characters, series, saga information. It lets users compete against the computer and themselves. 
The web application is very secure as it prevents SQLi,XSS attacks using htmlspecialchars, escaping strings, prepared statements. It also includes situational awareness which basically means the application logs invalid and valid login attempts. It also prevents brute force attacks. 

Admin has super privileges like adding new users, new characters, delete users, viewing log activity, and unrestricted access into the application. 

NOTE: You cannot use these codes for your own purpose without my permission.

Contact : sampreet.kishan@colorado.edu


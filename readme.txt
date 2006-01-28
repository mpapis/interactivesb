third release: 

copy to desired php folder, 
change rights for history.htm, mesage.htm, status.dat - allow write to them for all

for avoiding user name entrance each time use index.php?name=YourName

after a period of time try to clear history.htm, maybe as an cron task :)

changes from second release:
 - user list:
   - moved to right edge
   - idle time displayed only after more then 10 seconds of idle
   - clicking on user adds his/her name to edit field

corrected from first release:
 - write control focused on load
 - write control is cleared on IE (wasn't)
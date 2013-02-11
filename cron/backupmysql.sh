#! /bin/bash

# Ameir Abdeldayem
# http://www.ameir.net
# You are free to modify and distribute this code,
# so long as you keep my name and URL in it.

# your MySQL server's name
SERVER=myichimoku.eu

# directory to backup to
BACKDIR=~/myichimoku/backup

# date format that is appended to filename
DATE=`date +'%m-%d-%Y'`

#----------------------MySQL Settings--------------------#

# your MySQL server's location (IP address is best)
HOST=

# MySQL username
USER=

# MySQL password
PASS=

# List all of the MySQL databases that you want to backup in here, 
# each separated by a space
DBS=""

# set to 'y' if you want to backup all your databases. this will override
# the database selection above.
DUMPALL=n


#----------------------Mail Settings--------------------#

# set to 'y' if you'd like to be emailed the backup (requires mutt)
MAIL=n

# email addresses to send backups to, separated by a space
EMAILS="1@gmail.com 2@inbox.com 3@goowy.com"

SUBJECT="MySQL backup on $SERVER ($DATE)"

#----------------------FTP Settings--------------------#

# set "FTP=y" if you want to enable FTP backups
FTP=n

# FTP server settings; should be self-explanatory
FTPHOST=""
FTPUSER=""
FTPPASS=""

# directory to backup to. if it doesn't exist, file will be uploaded to 
# first logged-in directory
FTPDIR="MyIchimoku"

#-------------------Deletion Settings-------------------#

# delete old files?
DELETE=y

# how many days of backups do you want to keep?
DAYS=7

#----------------------End of Settings------------------#

# check of the backup directory exists
# if not, create it
if  [ -e $BACKDIR ]
then
	echo Backups directory already exists
else
	mkdir $BACKDIR
fi

if  [ $DUMPALL = "y" ]
then
	echo "Creating list of all your databases..."

	mysql -h $HOST --user=$USER --password=$PASS -e "show databases;" > dbs_on_$SERVER.txt

	# redefine list of databases to be backed up
	DBS=`sed -e ':a;N;$!ba;s/\n/ /g' -e 's/Database //g' dbs_on_$SERVER.txt`
fi

echo "Backing up MySQL databases..."
for database in $DBS
do
	mysqldump -h $HOST --user=$USER --password=$PASS $database > \
$BACKDIR/$SERVER-mysqlbackup-$database-$DATE.sql
	gzip -f -9 $BACKDIR/$SERVER-mysqlbackup-$database-$DATE.sql
done

# if you have the mail program 'mutt' installed on
# your server, this script will have mutt attach the backup
# and send it to the email addresses in $EMAILS

if  [ $MAIL = "y" ]
then
BODY="Your backup is ready! Find more useful scripts and info at http://www.ameir.net"
ATTACH=`for file in $BACKDIR/*$DATE.sql.gz; do echo -n "-a ${file} ";  done`

	echo "$BODY" | mutt -s "$SUBJECT" $ATTACH $EMAILS
        
	echo -e "Your backup has been emailed to you! \n"
fi

if  [ $FTP = "y" ]
then
echo "Initiating FTP connection..."
cd $BACKDIR
ATTACH=`for file in *$DATE.sql.gz; do echo -n -e "put ${file}\n"; done`

	ftp -nv <<EOF
	open $FTPHOST
	user $FTPUSER $FTPPASS
	cd $FTPDIR
	$ATTACH
	quit
EOF
echo -e  "FTP transfer complete! \n"
fi

if  [ $DELETE = "y" ]
then
	find $BACKDIR -name "*.sql.gz" -mtime $DAYS -exec rm {} \;

	if  [ $DAYS = "1" ]
	then
		echo "Yesterday's backup has been deleted."
	else
		echo "The backup from $DAYS days ago has been deleted."
	fi
fi

echo Your backup is complete!

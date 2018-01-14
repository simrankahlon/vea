You have an empty repository
To get started you will need to run these commands in your terminal.
Configure Git for the first time
git config --global user.name "Akash Gupta"
git config --global user.email "akash.gupta@atos.net"
Working with your repository
I just want to clone this repository
If you want to simply clone this empty repository then run this command in your terminal.
git clone https://a623048@stash.fsc.atos-services.net/scm/siem/acat-phase-2.git
My code is ready to be pushed
If you already have code ready to be pushed to this repository then run this in your terminal.
cd existing-project
git init
git add --all
git commit -m "Initial Commit"
git remote add origin https://a623048@stash.fsc.atos-services.net/scm/siem/acat-phase-2.git
git push -u origin master
My code is already tracked by Git
If your code is already tracked by Git then set this repository as your "origin" to push to.
cd existing-project
git remote set-url origin https://a623048@stash.fsc.atos-services.net/scm/siem/acat-phase-2.git
git push -u origin master
All done with the commands?
Refresh
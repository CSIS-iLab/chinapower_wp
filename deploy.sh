chmod 600 /tmp/chinapower_travis
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/chinapower_travis
git remote add chinapower_wp git@git.wpengine.com:staging/chinapower2017.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout master # switch to master branch
git add wp-content/themes/chinapower/*.css -f # force all compiled CSS files to be added
git commit -m "compiled assets" # commit the compiled CSS files
git push -f chinapower_wp master:master #deploy to staging site from master to master
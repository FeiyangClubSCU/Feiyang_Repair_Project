git checkout --orphan latest_branch
git add -A
git commit -am "UPDATE-OCT30/2020"
git branch -D master
git branch -m master
git push -f origin master
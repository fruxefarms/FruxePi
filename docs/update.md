# Updating
Run the following commands to update your FruxePi to the latest version. This is a sure way to get a fresh update!  

### Remove old version
```
sudo docker rm -f frxpi-APACHE frxpi-PHPMYADMIN frxpi-MYSQL
sudo docker system prune -a --volumes
sudo rm -r FruxePi
```

### Download and install new update
```
git clone https://github.com/fruxefarms/FruxePi.git
cd FruxePi
sudo bash install.sh
```
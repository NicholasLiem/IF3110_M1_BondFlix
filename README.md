# Tugas Besar 1 - Pengembangan Aplikasi Berbasis Web
## **Web App Description**
Bondflix adalah sebuah web app klon dari Netflix. Pada web ini, user dapat melakukan pendaftaran dan jika statusnya subscribed maka dapat melihat
video-video yang diinginkan. Selain itu, web ini juga menyediakan fitur-fitur manajemen bagi admin untuk melakukan perubahan terhadap user maupun konten yang ditayangkan pada website ini.

## **Requirements List**


## **How to Install The Program**
1. Clone this repository
```sh
https://github.com/NicholasLiem/SingleService.git
```
2. Change the current directory to `tugas-besar-1-wbd` folder
```sh
cd tugas-besar-1-wbd
```
3. Build and run your docker containers
```sh
docker-compose up -d --build
```
4. Make a new .env file based on .env.example (you can just remove .example from the file's name)
5. If for some reason the database is not seeded, you can manually seed using
```sh
docker exec -it single_service_app bash
```
```sh
yarn migration:run
```
6. (Docker Networking) Please look at this [monolith repository!](https://github.com/NicholasLiem/OHL_Monolith)

## **How to Run The Program**

## **Screenshot of Application**

## **Workload Breakdown**
# Tugas Besar 1 - Pengembangan Aplikasi Berbasis Web

![Logo](/assets/logo.png)

## **Deksripsi Web App - Web App Description**
Bondflix adalah sebuah web app klon dari Netflix. Pada web ini, user dapat melakukan pendaftaran dan jika statusnya subscribed maka dapat melihat
video-video yang diinginkan. Selain itu, web ini juga menyediakan fitur-fitur manajemen bagi admin untuk melakukan perubahan terhadap user maupun konten yang ditayangkan pada website ini.

## **Daftar Kebutuhan - Requirements List**
1. Pengguna dapat melihat, menyimpan, dan mencari konten/film yang diinginkan.
2. Admin dapat mengubah, menghapus, menambahkan pengguna, konten, dan atribut-atribut lain seperti genre.

## **Cara Menginstall dan Menjalankan Program - How to Install and Run The Program**
1. Clone this repository
```sh
git@gitlab.informatika.org:if3110-2023-k01-01-24/tugas-besar-1-wbd.git
```
2. Change the current directory to `tugas-besar-1-wbd` folder
```sh
cd tugas-besar-1-wbd
```
3. Make a new .env file based on .env.example (you can just remove .example from the file's name)
```sh
mv .env.example .env
```
4. Build and run your docker containers
```sh
docker-compose up -d --build
```
5. Run the server in your localhost with port 8080
```sh
http://localhost:8080/
```
6. [Optional] How to get admin access (1)
```sh
Register a new user in the web
```

7. [Optional] How to get admin access (1):
   Access the postgres container.
```sh
docker exec -it postgres-db sh
```

8. [Optional] How to get admin access (2): 
    Access the postgres db
```sh
psql -U wbdasik -d wbd_data
```

9. [Optional] How to get admin access (2):
    Run this SQL
```sql
UPDATE users SET is_admin = true WHERE username = your_username;
```

10. Congrats, now you can run the program normally!

## **Screenshot of Application**

## **Screenshot of Google Lighthouse**

## **Bonus yang dikerjakan**
1. Dockerize
2. Google Lighthouse

## **Pembagian Kerja - Workload Breakdown**
**Anggota Kelompok**

| Nama                   | NIM      | Panggilan |
|------------------------|----------|-----------|
| Cetta Reswara Parahita | 13521133 | Cetta     |
| Nicholas Liem          | 13521135 | Nicholas  |
| Haziq Abiyyu Mahdy     | 13521170 | Haziq     |

**Server Side:**

| NIM                | Nama            | Fungsionalitas                                                                                                                                                  |
|--------------------|-----------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 13521135, 13521170 | Nicholas, Haziq | Database Design,<br/>API Development                                                                                                                            |
| 13521135           | Nicholas        | Architecture Design <br/>(Docker, Setup, <br/>Folder Structuring, etc)                                                                                          |
| 13521135           | Nicholas        | Routing, <br/>AutoLoader, <br/>EnvLoader, <br/>Containers, <br/>Logging, <br/>Middlewares                                                                       |
| 13521135           | Nicholas        | Handlers, Services, Repositories, and Entities: <br/>AdminService, <br/>AuthService, <br/>MyListService, <br/>UploadService                                     |
| 13521170           | Haziq           | Handlers, Services, Repositories, and Entities: <br/>CategoryService, <br/>ContentService, <br/>GenreService, <br/>ContentRelationHandler and Repo (5 pcs each) |
| 13521135           | Nicholas        | Filtering and Paging Mechanism                                                                                                                                  |


**Client Side:**

| NIM                | Nama            | Fungsionalitas                                                                                                                                                                                                                                                 |
|--------------------|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 13521135, 13521170 | Nicholas, Haziq | Database Design,<br/>API Development                                                                                                                                                                                                                           |
| 13521135           | Nicholas        | Pages (HTML, CSS, JS): <br/>AdminUsers, <br/>AdminContent, <br/>UserDashboard, <br/>MyList, <br/>Search Functionality (Debounce), <br/>Modals, <br/>Filtering, <br/>HTTP Client / XMLHTTPRequest, <br/>404, <br/>Login, <br/>Logout, <br/>Index, <br/>Subscribe |
| 13521170           | Haziq           | Pages (HTML, CSS, JS): <br/>AdminMediaManagement, <br/>AdminContent, <br/>Watch, <br/>MyList, <br/>HTTP Client (File Upload)                                                                                                                   |
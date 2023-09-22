<?php
namespace Database;

class Seed {
    public static $adminSeedData = "
        INSERT INTO users VALUES 
        (1, 'admin', 'adminpassword', true, 'admin@admin.com')
    ";
}
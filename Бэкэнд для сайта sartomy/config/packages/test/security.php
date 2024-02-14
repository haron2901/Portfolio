<?php
use App\Entity\User;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security) {
    // ...

    // Используйте ваше имя класса пользователя здесь
    $security->passwordHasher(User::class)
        ->algorithm('plaintext'); // отключить хеширование (делайте это только в тестах!)

    // или использовать минимальные возможные значения
    $security->passwordHasher(User::class)
        ->algorithm('auto') // Должно быть то же значение, что и в config/packages/security.yaml
        ->cost(4) // Минимальное возможное значение для bcrypt
        ->timeCost(2) // Минимальное возможное значение для argon
        ->memoryCost(10) // Минимальное возможное значение для argon
    ;
};
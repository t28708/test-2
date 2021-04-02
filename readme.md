<h2>Install</h2>

<ol>
	<li>git clone https://github.com/t28708/laravel.git [name folder]</li>
    <li>cd [name folder]</li>
	<li>php artisan config:cache</li>
	<li>artisan storage:link</li>
	<li>artisan migrate</li>
	<li>yarn install</li>
	<li>npm audit fix</li>
	<li>npm run dev</li>
</ol>

 <ol>
 	Пояснение.
 <li>Защита от ПОВТОРНОГО голосовая путём удаления LocalStorage не сработает. То есть удалив localstorage можно голосовать повторно.</li>
 <li>Но мы вроде как зарегистрированы. Но опрос анонимный, так как я не создал поле user_id с привязкой к таблице user LARAVEl</li>
 <li>По-хорошему надо тянуть ОПРОС из БД, но это тестовое.</li>
 <li>Данные сейчас сохраняются в БД. Можно при помощи бэка их вытащить, в беке отсортировать и посчитать.</li>
 <li>И вывести сколько "кого" после голосования</li>

</ol>

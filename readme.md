<p align="center"><h1></h1>Есть 4 загона в которых вырастает живность</p>
Установка:
<ul>
<li>git clone https://github.com/turebekov/sheepcotes.git;</li>
<li>composer install;</li>
<li>Создать в базу(mysql);</li>
<li>Настроить env - fail;</li>
<li>php artisan migrate;</li>
<li>php artisan db:seed;</li>
</ul>
<ul>
Тестовое задание:
<li> Написать API с использованием RESTful</li>
<li> Работу на FronEnd-e с написанным API</li>
<li> Проектирование бд</li>
<li></li>
</ul>
Правила:
<li> 4 загона для овечек</li>
<li> изначальное количество овечек 10 расположены рандомно по загонам
</li>
<li> 1 день длится 10 секунд
</li>
<li> каждый день в одном из загонов где больше 1 овечки появляется ещё одна овечка
</li>
<li> каждый 10 день одну любую овечку забирают(сами знаете куда)
</li>
<li> если в загоне осталась одна овечка то берём загон где больше всего овечек и пересаживаем
</li>
<li>одну из них к одинокой овечке
</li>
<li> загоны никогда не должны быть пусты
</li>
<li> должен вестись счёт дней, который не обнуляется при обновлении страницы
</li>
<li> должна быть история действий происходящих в загонах(выводить никуда не надо)
</li>
<li></li>
<li></li>
</ul>


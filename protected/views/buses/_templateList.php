<?php
/* @var $model ListTourist */
/*
Формирование списков
- Слово “Обратный” меняется в зависимости от выбора даты возвращения.
- Маршрут выбранного автобуса (в зависимости от выезда или обратного списка):
       - если список “туда”, то выбираем маршрут из выпадающего списка прикреплённого к   названию автобуса в форме “Настройки”. Пример: Минск – Алушта – Портенит – Гурзуф – Ялта – Семиис).
       - если список “обратно”, то маршрут привязанный к названию автобуса (см. пример выше) меняется на : Семиис – Ялта – Гурзуф – Портенит – Алушта – Минск.
- Дата либо выезда пример (05.07.2012 – 16.07.2012) либо обратная (16.07.2012)
- Сортировка списка будет происходить по алфавиту названия курортов а затем по фамилиям
- далее выводится (ФИО, дата рождения и серия и номер паспорта)


*/
?>

<div style="text-align: center; font-size: 10pt;">
	<?php if($model->transit_type == Transittype::BACK): ?>
		<div>Обратный cписок туристов следующих по маршруту</div>
		<div><?php echo $model->getBackRoute(); ?></div>
		<div><?php echo $model->getBackDate();?></div>
	<?php elseif($model->transit_type == Transittype::THERE ): ?>
		<div>Cписок туристов следующих по маршруту</div>
		<div><?php echo $model->getThereRoute(); ?></div>
		<div><?php echo $model->getThereDate();?></div>
	<?php endif; ?>
</div>

<?php $dataProvider = $model->search(); ?>

<table class="items" border="1"  style="font-size: 10pt;" align="center">
	<thead >
		<tr>
			<th> №П/П </th><th> фио </th><th> город</th><th> год рождения</th><th> серия и № паспорта</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($dataProvider->getData() as $value) { ?>
		<tr>
			<td><?php echo $value['id']?></td>
			<td><?php echo $value['name']?></td>
			<td><?php echo $value['resort']?></td>
			<td><?php echo $value['birthday']?></td>
			<td><?php echo $value['passport']?></td>
			
		</tr>
		<?php }?>
	</tbody>
</table>

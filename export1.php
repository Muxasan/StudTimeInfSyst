<?PHP
include("bd.php");
$proj_id = $_GET['idd'];
$id = $_POST['id'];
//запрос и вывод данных

$query1 = mysqli_query($db,"SELECT Task_card.id, Task_card.task_card_name, Type_status.type_status_name, Task_card.laboriousness FROM Type_status, Task_card, Members 
WHERE '$proj_id'=Members.id_projects AND Task_card.id_members=Members.id AND Members.id='$id' AND Type_status.id=Task_card.id_status ORDER BY Task_card.id");

  require_once 'PHPExcel/Classes/PHPExcel.php';
  $phpexcel = new PHPExcel();
  $page = $phpexcel->setActiveSheetIndex(0);
  $page->setCellValue("A1", "Идентификатор");
  $page->setCellValue("B1", "Название задачи");
  $page->setCellValue("C1", "Статус");
  $page->setCellValue("D1", "Трудоёмкость");
 
$s = 1;
while($row=mysqli_fetch_array($query1))
{
$s++;
  $page->setCellValue("A$s", $row['id']); 
  $page->setCellValue("B$s", $row['task_card_name']);
  $page->setCellValue("C$s", $row['type_status_name']);
  $page->setCellValue("D$s", $row['laboriousness']);   
}
  $page->setTitle("Vigruzka");
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("Vigruzka_po_uchastniku.xlsx");
  $file = 'Vigruzka_po_uchastniku.xlsx';
  if (file_exists($file)) {
    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
    // если этого не сделать файл будет читаться в память полностью!
    if (ob_get_level()) {
      ob_end_clean();
    }
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: utf-8');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // читаем файл и отправляем его пользователю
    readfile($file);
  }
//фильтруем данные

echo '<script>window.location.href = "total_task_list.php?idd='.$proj_id.'";</script>';
?>
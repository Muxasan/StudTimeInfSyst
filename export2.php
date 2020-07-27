<?PHP
include("bd.php");
//запрос и вывод данных

$query1 = mysqli_query($db,"SELECT * FROM Projects WHERE Projects.id!=10");

  require_once 'PHPExcel/Classes/PHPExcel.php';
  $phpexcel = new PHPExcel();
  $page = $phpexcel->setActiveSheetIndex(0);
  $page->setCellValue("A1", "Название проекта");
  $page->setCellValue("B1", "Год создания");
  $page->setCellValue("C1", "Общее количество задач");
  $page->setCellValue("D1", "Общая трудоёмкость");
  $page->setCellValue("E1", "Фактическое время выполнения задач");
  $page->setCellValue("F1", "Оценка за проект");
$s = 1;
while($row = mysqli_fetch_array($query1))
{
    $s++;
    $idpr = $row['id'];
    $query112 = mysqli_query($db, "SELECT * FROM Projects, Task_card, Members WHERE Members.id = Task_card.id_members AND Projects.id = Members.id_projects AND Projects.id = '$idpr'");
    while ($row112 = mysqli_fetch_array($query112))
    {
        $tasksum = $tasksum + 1;
        $trudsum = $trudsum + $row112['laboriousness'];
        $realtrudsum = $realtrudsum + $row112['worktime'];
        $memberscount = $memberscount + 1;
    }
    $page->setCellValue("A$s", $row['proj_name']); 
    $page->setCellValue("B$s", $row['date_creation']);
    $page->setCellValue("C$s", $tasksum);
    $page->setCellValue("D$s", $trudsum);
    $page->setCellValue("E$s", $realtrudsum);
    if ($realtrudsum == 0)
    {
        $ocenkatrud = 0;
    }
    else
    {
    $ocenkatrud = ($realtrudsum / $trudsum)*100;
    $ocenkatrud = $ocenkatrud / $memberscount;
    $ocenkatrud = number_format($ocenkatrud, 1);
    }
    $page->setCellValue("F$s", $ocenkatrud);
    $tasksum = 0;
    $trudsum = 0;
    $realtrudsum = 0;
    $ocenkatrud = 0;
}
  $page->setTitle("Statistika"); 
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("Statistika_po_proektam.xlsx");
  $file = 'Statistika_po_proektam.xlsx';
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

echo '<script>window.location.href = "final_project_report.php";</script>';
?>
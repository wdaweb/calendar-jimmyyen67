* class 不要用大小寫來命名，儘可能都是小寫，然後使用'-'來分隔
  * 比如 the-date-y,select,loader1,month-button 等等
* class TheDateBig設為position:absolute後就不受display:flex的控制了，所以如果想在flex中對子元素做絕對定位的功能，需要同時做以下的處理：
  * 上層元素要有position:relative，才能讓absolute的元素被包含其中，否則absolute的元件會以整個網頁的最左上角為定位點
  * 絕對置中的物件不需要使用absolute來定位，使用flex的置中功能即可
* 專案的首頁儘量以index.php來命名，相關的連結亦做相應的修改
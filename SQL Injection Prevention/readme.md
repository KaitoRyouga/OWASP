# SQL Injection Prevention

## Mục lục

* [Đừng bao giờ quá tin tưởng dữ liệu của user nhập vào, hãy luôn luôn lọc dũ liệu trước khi đưa vào database](#filter)
* [Sử dụng các ORM (Object-Relational Mapping) framework thay vì sử dụng sql thuần](#ORM)
* [Không hiển thị exception, message lỗi 1 cách chi tiết cho user. Nên dùng `try catch` để thông báo lỗi 1 cách đơn giản cho user hiểu là đủ](#exception)
* [Sử dụng Prepared Statements thay vì cộng chuỗi trong các câu truy vấn sql](#Prepared)
* [Sử dụng Stored Procedures](#Procedures)
* [Phân quyền rõ ràng trong Database](#pq)
* [Backup dữ liệu thường xuyên](#Backup)
* [Hãy loại bỏ các kí tự meta](#meta)
* [Khi nhận các ký tự với các giá trị numeric, hãy chắc chắn chúng các integer](#numeric)
* [Xóa các stored procedure trong database master không cần thiết](#delete)
* [Mã hoá lại tất cả các dữ liệu nhạy cảm trong databas](#hash)

<a name = "filter"></a>
## Đừng bao giờ quá tin tưởng dữ liệu của user nhập vào, hãy luôn luôn lọc dũ liệu trước khi đưa vào database

- Cách phòng chống này tương tự như XSS. Ta sử dụng filter để lọc các kí tự đặc biệt (; ” ‘) hoặc các từ khoá (SELECT, UNION) do user nhập vào. 
- Tuy nhiên Nên sử dụng thư viện/function được cung cấp bởi framework. Viết lại từ đầu vừa tốn thời gian vừa dễ sơ sót.

---

<a name = "ORM"></a>
## Sử dụng các ORM (Object-Relational Mapping) framework thay vì sử dụng sql thuần

- Object-Relational Mapping (ORM) là một kỹ thuật cho phép truy vấn và thao tác dữ liệu từ cơ sở dữ liệu bằng cách sử dụng một mô hình hướng đối tượng. Khi nói về công nghệ này, hầu hết mọi người đang đề cập đến một thư viện thực hiện các kỹ thuật Object-Relational Mapping, hay còn biết đến với tên viết tắt là “ORM”.
- Các framework web này sẽ tự tạo câu lệnh SQL nên attacker cũng khó tấn công hơn.
- Ngoài việc hạn chế bị tấn công sql injection thì còn 1 số lợi ích khác khi sủ dụng ORM:
    + Hiệu suất cao
    + Linh hoạt trong thiết kế ứng dụng
    + Tái sử dụng Code tối ưu
    + Khả năng mở rộng ứng dụng

---
<a name = "exception"></a>
## Không hiển thị exception, message lỗi 1 cách chi tiết cho user. Nên dùng `try catch` để thông báo lỗi 1 cách đơn giản cho user hiểu là đủ

- Attacker dựa vào message lỗi để tìm ra cấu trúc database. Khi có lỗi, ta chỉ hiện thông báo lỗi chứ đừng hiển thị đầy đủ thông tin về lỗi, tránh attacker lợi dụng.

---

<a name = "Prepared"></a>
## Sử dụng Prepared Statements thay vì cộng chuỗi trong các câu truy vấn sql

- Như trong PDO của PHP, sử dụng `bindParam()`
- VD: 

```
...
$stmt = $db->prepare('INSERT INTO users (name, email, age) values (:name, :mail, :age)');
$stmt->bindParam(':name', 'Kaito');
$stmt->bindParam(':mail', 'email_address');
$stmt->bindParam('age', 19);
$stmt->execute();
...
```

- Đầu tiên chúng ta sẽ tạo một Prepared Statement thông qua hàm prepare(). Ở đây chúng ta không truyền giá trị trực tiếp cho name, mail và age. Thay vào đó chúng ta sẽ sử dụng các place holder để giữ chỗ cho giá trị của các biến trên. Tiếp theo chúng ta tiến hành gắn giá trị cho các place holder vào câu lệnh Prepared Statement thông qua hàm 
`bindParam($tên_place_holder, $giá_trị_của_place_holder)`. Cuối cùng chúng ta thực thi prepared statement thông qua lệnh `execute()`.

---

<a name = "Procedures"></a>
## Sử dụng Stored Procedures

- Stored Procedure trong mysql là những hàm (Procedure) để thực hiện những dòng lệnh liên quan trong đó, ví dụ như thao tác Update hay Insert.
- 1 số điểm mạnh khi dùng Stored Procedure:
    + giúp giảm thời gian giao tiếp giữa các ứng dụng với hệ quản trị MYSQL, bởi vì thay vì gửi nhiều câu lệnh dài thì ta chỉ cần gọi tới một thủ tục và trong thủ tục này sẽ thực hiện nhiều câu lệnh SQL.
    + giúp các ứng dụng nhìn minh bạch hơn, nghĩa là khi ta định nghĩa các thao tác xử lý vào một Stored thì công việc của các ngôn ngữ lập trình khác chỉ quan tâm đến tên thủ tục, các tham số truyền vào chứ không cần biết nó thực hiện như thế nào. Điều này giúp các team làm việc tốt hơn, ta sẽ phân ra bộ phận Coder riêng và bộ phận viết thủ tục riêng.
    + Mỗi thủ tục sẽ có các mức độ truy cập, nghĩa là ta có thể cấp quyền sử dụng cho một Uesr nào đó trong hệ quản trị (Lưu ý là user trong hệ quản trị chứ không phải là admin của ứng dụng website).
- Ngoài ra Stored Procedure cũng có 1 số nhược điểm sau:
    + Nếu có quá nhiều Procedure thì hệ quản trị sẽ sử dụng bộ nhớ để lưu trữ các thủ tục này khá nhiều. Ngoài ra nếu ta thực hiện quá nhiều xử lý trong mỗi thủ tục thì đồng nghĩa với việc CPU sẽ làm việc nặng hơn, điều này không tốt chút nào.
    + Nếu sử dụng thủ tục thì sẽ rất khó phát triển trong ứng dụng, gây khó khăn ở mức logic business.
    + 1 số hệ quản trị CSDL có những tool hỗ trợ Debug Store nhưng MYSQL thì không có.
    + Để phát triển ứng dụng thì bạn phải đòi hỏi có một kỹ năng thật siêu đăng  mà không phải nhà thiết kế cơ sở dữ liệu nào cũng có. Điều này dễ bị phá cho vấn đề bảo trì và nâng cấp
- Cấu trúc lệnh trong Stored Procedure :

```
CREATE PROCEDURE [procedure_name] ([param1, param2,…])
	BEGIN
		[sql_statements]
   	END
```

`CREATE PROCEDURE là câu lệnh dùng để khai báo Stored Procedure trong MySQL`.

`[procedure_name] là tên của Stored Procedure`.

`[param1, param2,…] là các tham số truyền vào Store Procedure`.

---

<a name = "pq"></a>
## Phân quyền rõ ràng trong Database

- Nếu chỉ truy cập dữ liệu từ một số bảng, hãy tạo một account trong Database, gán quyền truy cập cho account đó chứ đừng dùng account root hay sa. Lúc này, dù attacker có inject được sql cũng không thể đọc dữ liệu từ các bảng chính, sửa hay xoá dữ liệu.

---

<a name = "Backup"></a>
## Backup dữ liệu thường xuyên

- Luôn phải đề phòng trường hợp xấu nhất, dữ liệu phải thường xuyên được backup để nếu có bị attacker xoá thì ta vẫn có thể khôi phục được.

---

<a name = "meta"></a>
## Hãy loại bỏ các kí tự meta, extend

- Hãy loại bỏ các kí tự meta như '"/\; và các kí tự extend như NULL, CR, LF, ... trong các string nhận được từ:
    + input do người dùng gửi lên server
    + các tham số từ URL
    + các giá trị từ cookie

---

<a name = "numeric"></a>
## Khi nhận các ký tự với các giá trị numeric, hãy chắc chắn chúng các integer

- Đối với các giá trị numeric, hãy chuyển nó sang integer trước khi query SQL, hoặc dùng ISNUMERIC để chắc chắn nó là một số integer.

---

<a name = "delete"></a>
## Xóa các stored procedure trong database master không cần thiết

- Đôi khi 1 số thiết lập không cần thiết lại là đòn bẩy cho attacker tấn công vào trang web
- Nên ta cần xoá các stored procedure trong database master mà không dùng như:
    + xp_cmdshell
    + xp_startmail
    + xp_sendmail
    + sp_makewebtask

---

<a name = "h"></a>
## Mã hoá lại tất cả các dữ liệu nhạy cảm trong database

- Không phỉa lúc nào ta cũng tạo được lớp phòng thủ chắc chắn trước các cuộc tấn công sql injection. Cho nên để đề phòng attacker tấn công vô được database của ta thì attacker cũng không lấy được dữ liệu có giá trị nhiều bằng cách mã hoá lại tất cả các dữ liệu nhạy cảm. Kết hợp phân quyền rõ ràng trong database, đây sẽ là phương án tốt dù có bị tấn công sql injection đi chăng nữa.



SQL tạo database
CREATE DATABASE TEST1;
USE TEST1;

CREATE TABLE NgànhHoc (
    MaNganh CHAR(4) PRIMARY KEY,
    TenNganh NVARCHAR(30)
);

CREATE TABLE SinhVien (
    MaSV CHAR(10) PRIMARY KEY,
    HoTen NVARCHAR(50) NOT NULL,
    GioiTinh NVARCHAR(5),
    NgaySinh DATE,
    Hinh VARCHAR(50),
    MaNganh CHAR(4),
    FOREIGN KEY (MaNganh) REFERENCES NgànhHoc(MaNganh)
);


CREATE TABLE HocPhan (
    MaHP CHAR(6) PRIMARY KEY,
    TenHP NVARCHAR(30) NOT NULL,
    SoTinChi INT
);


CREATE TABLE DangKy (
    MaDK INT AUTO_INCREMENT PRIMARY KEY,
    NgayDK DATE,
    MaSV CHAR(10),
    FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV)
);


CREATE TABLE ChiTietDangKy (
    MaDK INT,
    MaHP CHAR(6),
    FOREIGN KEY (MaDK) REFERENCES DangKy(MaDK),
    FOREIGN KEY (MaHP) REFERENCES HocPhan(MaHP),
    PRIMARY KEY (MaDK, MaHP)
);


INSERT INTO NgànhHoc (MaNganh, TenNganh) VALUES ('CNTT', N'Công nghệ thông tin');
INSERT INTO NgànhHoc (MaNganh, TenNganh) VALUES ('QTKD', N'Quản trị kinh doanh');

INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
VALUES ('0123456789', N'Nguyễn Văn A', N'Nam', '2000-02-12', '/Content/images/sv1.jpg', 'CNTT');
INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
VALUES ('9876543218', N'Nguyễn Thị B', N'Nữ', '2000-07-03', '/Content/images/sv2.jpg', 'QTKD');


INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES ('CNTT01', N'Lập trình C', 3);
INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES ('QTKD01', N'Kinh tế vi mô', 2);
INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES ('QTKD02', N'Xác suất thống kê', 1.3);

SELECT * FROM SinhVien;
SELECT * FROM NgànhHoc;
SELECT * FROM HocPhan;
SELECT * FROM DangKy;
SELECT * FROM chitietdangky;
ALTER TABLE DangKy
ADD COLUMN TrangThai VARCHAR(20) DEFAULT 'ChuaLuu';
ALTER TABLE HocPhan
ADD COLUMN SoLuongDuKien INT DEFAULT 100;

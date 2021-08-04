<?php
define( 'WP_CACHE', true );
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'wordpress' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Q(Dg;N?,f+u-8ep.1|jPTGPT8Vq$5Y@x_$cD!>o5yiU+7ZJHQm;xmCG13X3#&P=E' );
define( 'SECURE_AUTH_KEY',  'K8~X(Sx}IE)Br#&1wz>Bo5HWP;U6;H+R9Q6Nkd?lMJe)#]Sf>+8uI=)^%]8GQK:c' );
define( 'LOGGED_IN_KEY',    '|>#Ig!(-BrDFaHD.yOcP_:?XO}>!Ff2u}Q~Bi[t,n,TdKe go NluR/b]K<TJ]%8' );
define( 'NONCE_KEY',        'el;_}swZQujG%P|NQast`_;d6,-aU)]%0&Q?_H+|)vF2^f9~(BDbAa9qWX861Vc*' );
define( 'AUTH_SALT',        '4 Z,jS]/^8wWm1o0!poR+ilrYI_aP+^[NrM>xdRBs<;vb)p]hs8ISuhBZ&[]cIRt' );
define( 'SECURE_AUTH_SALT', '>,*+=iT^ 3;bAPGFy:G<j?.AU<+PNoKmO{uS%H[iSL&IgmWW^.Z=&fDy[r9M_;a2' );
define( 'LOGGED_IN_SALT',   'd!1AY,9#zKz`da3a4[gcWWh0#(`PQpR@:oa+:T8[8r3=N-SF]a^qp~q]dQgQo qW' );
define( 'NONCE_SALT',       '?XVTUj(u_JC8Z8|%)MtK@(>&:#B|Wu4d[Hl.Ll^ch_S9E[mXvz}lp]H|&t!RMOhC' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');

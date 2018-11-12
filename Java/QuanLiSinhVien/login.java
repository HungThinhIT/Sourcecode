package qlsv;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.ImageIcon;
import java.awt.Color;
import java.awt.Toolkit;

public class login {

	private JFrame frmLoginForm;
	private JTextField tfUsername;
	private JPasswordField tfPassword;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					login window = new login();
					window.frmLoginForm.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public login() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frmLoginForm = new JFrame();
		frmLoginForm.setIconImage(Toolkit.getDefaultToolkit().getImage("D:\\Icon_QLSV\\Frame\\login.png"));
		frmLoginForm.setTitle("Login Form");
		frmLoginForm.setBounds(100, 100, 450, 300);
		frmLoginForm.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		frmLoginForm.getContentPane().setLayout(null);
		
		JLabel lblUsername = new JLabel("T\u00E0i kho\u1EA3n");
		lblUsername.setIcon(new ImageIcon("D:\\Icon_QLSV\\login\\png\\003-user.png"));
		lblUsername.setFont(new Font("Tahoma", Font.PLAIN, 17));
		lblUsername.setBounds(78, 75, 122, 35);
		frmLoginForm.getContentPane().add(lblUsername);
		
		JLabel lblPassword = new JLabel("M\u1EADt kh\u1EA9u");
		lblPassword.setIcon(new ImageIcon("D:\\Icon_QLSV\\login\\png\\002-business.png"));
		lblPassword.setFont(new Font("Tahoma", Font.PLAIN, 17));
		lblPassword.setBounds(78, 123, 122, 35);
		frmLoginForm.getContentPane().add(lblPassword);
		
		tfUsername = new JTextField();
		tfUsername.setBounds(212, 83, 116, 22);
		frmLoginForm.getContentPane().add(tfUsername);
		tfUsername.setColumns(10);
		
		tfPassword = new JPasswordField();
		tfPassword.setBounds(212, 131, 115, 22);
		frmLoginForm.getContentPane().add(tfPassword);
		
		JButton btnLogin = new JButton("\u0110\u0103ng Nh\u1EADp");
		btnLogin.setIcon(new ImageIcon("D:\\Icon_QLSV\\login\\png\\001-login.png"));
		btnLogin.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				
				String user = tfUsername.getText();
				@SuppressWarnings("deprecation")
				String pass = tfPassword.getText();
				
				if(user.equals("admin") && pass.equals("123456")      ) {
					JOptionPane.showMessageDialog(null, "Đăng nhập thành công");

					thongtin obj = new thongtin();
					obj.setVisible(true);
					
				}
				else {
					JOptionPane.showMessageDialog(btnLogin, "Sai tên tài khoản hoặc mật khẩu !", "Lỗi !!", JOptionPane.ERROR_MESSAGE);
				
				}
				
				

			}
		});
		btnLogin.setBounds(153, 186, 135, 35);
		frmLoginForm.getContentPane().add(btnLogin);
		
		JLabel lblquanlysv = new JLabel("\u0110\u0103ng nh\u1EADp");
		lblquanlysv.setForeground(Color.RED);
		lblquanlysv.setFont(new Font("Tahoma", Font.PLAIN, 34));
		lblquanlysv.setBounds(125, 13, 183, 49);
		frmLoginForm.getContentPane().add(lblquanlysv);
		
		JLabel lblTiKhonAdmin = new JLabel("T\u00E0i kho\u1EA3n: admin   | M\u1EADt kh\u1EA9u 123456");
		lblTiKhonAdmin.setBounds(98, 224, 223, 16);
		frmLoginForm.getContentPane().add(lblTiKhonAdmin);
	}
}

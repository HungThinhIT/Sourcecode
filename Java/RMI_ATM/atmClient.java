import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.UIManager;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.nio.channels.ShutdownChannelGroupException;
import java.rmi.Naming;
import java.awt.event.ActionEvent;
import javax.swing.ImageIcon;
import java.awt.Color;

public class atmClient extends JFrame {

	private JPanel contentPane;
	private JTextField tfMyID;
	private JTextField tfmymoney;
	private JTextField tfTienNhapRut;
	private JLabel lblIDLogin;
	private int checkmon = 0;
	/**
	 * Launch the application.
	 */
	public void checkmoney() {
		try {
			atmITF cal = (atmITF) Naming.lookup("rmi://localhost/objectATM");
			checkmon = cal.checkmymoney();
		} catch (Exception e) {
			// TODO: handle exception
		}
	}
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());

					atmClient frame = new atmClient();
					frame.setVisible(true);

					//AUTHENTICATION - HUNGTHINHBANK
					String ID = JOptionPane.showInputDialog(null, "Nhap vao ID (1)");
					String Pwd = JOptionPane.showInputDialog(null, "Nhap Password (123456)");
					if(ID.equals("1") && Pwd.equals("123456")) {
						frame.setVisible(true);
						
					}
					else {
						JOptionPane.showMessageDialog(null, "Sai ID hoac Password, Chuong trinh se thoat");
						frame.setVisible(false);
					}
					//END_ AUTHENTICATION
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public atmClient() {
		setTitle("ATM Hưng Thịnh (RMI Application)");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 579, 545);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblAtmHngThnh = new JLabel("ATM H\u01AFNG TH\u1ECANH");
		lblAtmHngThnh.setFont(new Font("Calibri", Font.PLAIN, 35));
		lblAtmHngThnh.setBounds(144, 30, 283, 55);
		contentPane.add(lblAtmHngThnh);
		
		JLabel lblId = new JLabel("ID");
		lblId.setFont(new Font("Calibri", Font.PLAIN, 40));
		lblId.setBounds(31, 182, 56, 41);
		contentPane.add(lblId);
		
		tfMyID = new JTextField();
		tfMyID.setForeground(Color.RED);
		tfMyID.setFont(new Font("Calibri", Font.PLAIN, 20));
		tfMyID.setBounds(172, 182, 294, 41);
		contentPane.add(tfMyID);
		tfMyID.setColumns(10);
		tfMyID.disable();
		
		JLabel lblTinCaBn = new JLabel("S\u1ED1 d\u01B0");
		lblTinCaBn.setFont(new Font("Calibri", Font.PLAIN, 40));
		lblTinCaBn.setBounds(30, 236, 93, 41);
		contentPane.add(lblTinCaBn);
		
		tfmymoney = new JTextField();
		tfmymoney.setForeground(Color.RED);
		tfmymoney.setFont(new Font("Calibri", Font.PLAIN, 20));
		tfmymoney.setColumns(10);
		tfmymoney.setBounds(172, 236, 294, 41);
		contentPane.add(tfmymoney);
		tfmymoney.disable();
		tfTienNhapRut = new JTextField();
		tfTienNhapRut.setFont(new Font("Calibri", Font.PLAIN, 20));
		tfTienNhapRut.setBounds(172, 292, 294, 41);
		contentPane.add(tfTienNhapRut);
		tfTienNhapRut.setColumns(10);
		
		JLabel lblTinNhprt = new JLabel("Tiền GD");
		lblTinNhprt.setFont(new Font("Calibri", Font.PLAIN, 40));
		lblTinNhprt.setBounds(31, 292, 129, 43);
		contentPane.add(lblTinNhprt);
		
		JButton btnNaptien = new JButton("N\u1EA1p ti\u1EC1n");
		btnNaptien.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				try {
					atmITF cal = (atmITF) Naming.lookup("rmi://localhost/objectATM");
					int tiennhap = Integer.parseInt(tfTienNhapRut.getText());
					int check = cal.naptien(tiennhap);
					if(check != tiennhap) {
						JOptionPane.showMessageDialog(null,"Nap thanh cong "+tiennhap+"VND vao ngan hang");
					}
					else {
						JOptionPane.showMessageDialog(null,"Nap tien that bai");
					}
					tfTienNhapRut.setText("");
					
				} catch (Exception e) {
					// TODO: handle exception
				}
			}
		});
		btnNaptien.setBounds(208, 373, 155, 55);
		contentPane.add(btnNaptien);
		
		JButton btnRutTien = new JButton("R\u00FAt ti\u1EC1n");
		btnRutTien.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				try {
					atmITF cal = (atmITF) Naming.lookup("rmi://localhost/objectATM");
					
					int tiennhap = Integer.parseInt(tfTienNhapRut.getText());
					checkmoney();
					if(checkmon > tiennhap) {
						JOptionPane.showMessageDialog(null,"rut tien thanh cong "+tiennhap+"VND tu ngan hang");
						cal.ruttien(tiennhap);
					}
					else {
						JOptionPane.showMessageDialog(null,"rut tien that bai");
					}
					tfTienNhapRut.setText("");
					
				} catch (Exception e) {
					// TODO: handle exception
				}
			}
		});
		btnRutTien.setBounds(394, 373, 155, 55);
		contentPane.add(btnRutTien);
		
		JButton btnTruyVan = new JButton("Truy v\u1EA5n t\u00E0i kho\u1EA3n");
		btnTruyVan.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				try {
					lblIDLogin.setText("Chào mừng ID: 1 đến với ATM Hưng Thịnh");
					atmITF cal = (atmITF) Naming.lookup("rmi://localhost/objectATM");

					int sodu = cal.checkmymoney();
					int id = cal.checkmyID();
					tfMyID.setText(String.valueOf(id));
					tfmymoney.setText(String.valueOf(sodu)+".00 VNĐ");
					
					
				} catch (Exception e) {
					// TODO: handle exception
				}
			}
		});
		btnTruyVan.setBounds(12, 373, 155, 55);
		contentPane.add(btnTruyVan);
		
		lblIDLogin = new JLabel("");
		lblIDLogin.setBounds(154, 85, 266, 16);
		contentPane.add(lblIDLogin);
		
		JLabel lblHngThnh = new JLabel("Author: Hưng Thịnh - Email: nhtnokia@gmail.com/nhthinh.17it2@sict.udn.vn");
		lblHngThnh.setBounds(112, 474, 449, 16);
		contentPane.add(lblHngThnh);
	}
}

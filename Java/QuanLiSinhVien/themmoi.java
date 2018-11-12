package qlsv;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.JRadioButton;
import javax.swing.ButtonGroup;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.Statement;
import java.awt.event.ActionEvent;
import javax.swing.ImageIcon;
import java.awt.Toolkit;

public class themmoi extends JFrame {

	private JPanel contentPane;
	private JTextField tfMaSV;
	private JTextField tfTenSV;
	private JTextField tfNamsinh;
	private JTextField tfQuequan;
	private JRadioButton rdbtnNam;
	private JRadioButton rdbtnNu;
	
	Connection conn;
	Statement st;
	ResultSet rs;
	ResultSetMetaData rsm;
	private JTextField tfSDT;
	private JTextField tfEmail;
	private JTextField tfClass;
	private JTextField tfNganh;
	private JLabel lblNganh;
	
	public void connectDB(){
		
		try {
			Class.forName("com.mysql.jdbc.Driver");
			conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/qlsv", "root", "");
		}
		catch(Exception ex) {
			
			
		}
		
		
		
	}
	
	
	
	
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					themmoi frame = new themmoi();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public themmoi() {
		setIconImage(Toolkit.getDefaultToolkit().getImage("D:\\Icon_QLSV\\Frame\\create-group-button.png"));
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setTitle("Th\u00EAm m\u1EDBi sinh vi\u00EAn");
		setBounds(100, 100, 627, 767);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblThmSinhVin = new JLabel("TH\u00CAM SINH VI\u00CAN");
		lblThmSinhVin.setFont(new Font("Tahoma", Font.PLAIN, 50));
		lblThmSinhVin.setBounds(107, 13, 399, 100);
		contentPane.add(lblThmSinhVin);
		
		JLabel lblMaSV = new JLabel("M\u00E3 sinh vi\u00EAn");
		lblMaSV.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\003-id-card-1.png"));
		lblMaSV.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblMaSV.setBounds(57, 126, 139, 35);
		contentPane.add(lblMaSV);
		
		JLabel lblTenSV = new JLabel("T\u00EAn sinh vi\u00EAn");
		lblTenSV.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\004-id-card.png"));
		lblTenSV.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblTenSV.setBounds(57, 191, 164, 35);
		contentPane.add(lblTenSV);
		
		JLabel lblNamsinh = new JLabel("N\u0103m sinh");
		lblNamsinh.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\002-seventeen.png"));
		lblNamsinh.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblNamsinh.setBounds(57, 312, 124, 35);
		contentPane.add(lblNamsinh);
		
		JLabel lblQuequan = new JLabel("Qu\u00EA qu\u00E1n");
		lblQuequan.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\001-cityscape.png"));
		lblQuequan.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblQuequan.setBounds(57, 372, 124, 35);
		contentPane.add(lblQuequan);
		
		tfMaSV = new JTextField();
		tfMaSV.setBounds(233, 126, 259, 31);
		contentPane.add(tfMaSV);
		tfMaSV.setColumns(10);
		
		tfTenSV = new JTextField();
		tfTenSV.setColumns(10);
		tfTenSV.setBounds(233, 191, 259, 31);
		contentPane.add(tfTenSV);
		
		tfNamsinh = new JTextField();
		tfNamsinh.setColumns(10);
		tfNamsinh.setBounds(233, 312, 259, 31);
		contentPane.add(tfNamsinh);
		
		tfQuequan = new JTextField();
		tfQuequan.setColumns(10);
		tfQuequan.setBounds(233, 372, 259, 31);
		contentPane.add(tfQuequan);
		
		
		ButtonGroup btGR = new ButtonGroup();
		//BUTTON GT
		rdbtnNam = new JRadioButton("Nam");
		rdbtnNam.setFont(new Font("Tahoma", Font.PLAIN, 20));
		rdbtnNam.setBounds(237, 604, 69, 25);
		contentPane.add(rdbtnNam);
		
		rdbtnNu = new JRadioButton("Nu");
		rdbtnNu.setFont(new Font("Tahoma", Font.PLAIN, 20));
		rdbtnNu.setBounds(372, 604, 69, 25);
		contentPane.add(rdbtnNu);
		
		btGR.add(rdbtnNam);
		btGR.add(rdbtnNu);
		
		
		
		// END BUTTON GT
		JLabel lblGioitinh = new JLabel("Gi\u1EDBi t\u00EDnh");
		lblGioitinh.setIcon(new ImageIcon("D:\\Icon_QLSV\\masculine.png"));
		lblGioitinh.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblGioitinh.setBounds(57, 599, 124, 35);
		contentPane.add(lblGioitinh);
			
		JButton btnThem = new JButton("Th\u00EAm");
		btnThem.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\004-people.png"));
		btnThem.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					connectDB();
					st = conn.createStatement();
					
					String gioitinh = "";
					if(rdbtnNam.isSelected()) {
						gioitinh = rdbtnNam.getText();
					}
					if(rdbtnNu.isSelected()) {
						gioitinh = rdbtnNu.getText();
					}
					
					int i = st.executeUpdate("Insert into sinhvien(idSinhvien,tensv,class,namsinh,quequan,gioitinh,email,sdt,nganhhoc) values( '"+tfMaSV.getText()+"','"+tfTenSV.getText()+"','"+tfClass.getText()+"','"+tfNamsinh.getText()+"','"+tfQuequan.getText()+"','"+gioitinh+"','"+tfEmail.getText()+"','"+tfSDT.getText()+"','"+tfNganh.getText()+"')");
					if(i>0) { 
						JOptionPane.showMessageDialog(null, "Thêm dữ liệu thành công");
						try {
							
							//THEM DU LIEU XONG XE XOA HET TEXTFIELD
							tfMaSV.setText("");
							tfClass.setText("");
							tfEmail.setText("");
							tfNamsinh.setText("");
							tfNganh.setText("");
							tfQuequan.setText("");
							tfSDT.setText("");
							tfTenSV.setText("");
							
						}
						catch (Exception ex) {
							
						}
						
					}
					else JOptionPane.showConfirmDialog(null, "thêm dữ liệu thất bại");
					
					
				} 
				catch (Exception ex) {
					
					
					
				}
				
				
				
				
				

			}
		});
		btnThem.setBounds(272, 647, 124, 35);
		contentPane.add(btnThem);
		
		tfSDT = new JTextField();
		tfSDT.setColumns(10);
		tfSDT.setBounds(233, 490, 259, 31);
		contentPane.add(tfSDT);
		
		JLabel lblSdt = new JLabel("Số điện thoại");
		lblSdt.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\smartphone.png"));
		lblSdt.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblSdt.setBounds(57, 490, 164, 35);
		contentPane.add(lblSdt);
		
		JLabel lblEmail = new JLabel("Email");
		lblEmail.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\email.png"));
		lblEmail.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblEmail.setBounds(57, 431, 124, 35);
		contentPane.add(lblEmail);
		
		tfEmail = new JTextField();
		tfEmail.setColumns(10);
		tfEmail.setBounds(233, 431, 259, 31);
		contentPane.add(tfEmail);
		
		tfClass = new JTextField();
		tfClass.setColumns(10);
		tfClass.setBounds(233, 252, 259, 31);
		contentPane.add(tfClass);
		
		JLabel lblClass = new JLabel("Lớp");
		lblClass.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\teacher-desk.png"));
		lblClass.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblClass.setBounds(57, 252, 164, 35);
		contentPane.add(lblClass);
		
		tfNganh = new JTextField();
		tfNganh.setColumns(10);
		tfNganh.setBounds(233, 552, 259, 31);
		contentPane.add(tfNganh);
		
		lblNganh = new JLabel("Ngành học");
		lblNganh.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\gadget.png"));
		lblNganh.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblNganh.setBounds(57, 552, 124, 35);
		contentPane.add(lblNganh);
	}
}

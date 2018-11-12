package qlsv;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;


import javax.swing.JLabel;
import javax.swing.JOptionPane;

import java.awt.Font;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;

import javax.swing.JButton;
import javax.swing.JTextField;
import javax.swing.UIManager;
import javax.swing.JTable;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.awt.event.ActionEvent;
import javax.swing.JScrollPane;

import java.awt.Color;

import javax.swing.JProgressBar;
import javax.swing.ImageIcon;
import java.awt.Toolkit;

public class thongtin extends JFrame {

	private JPanel contentPane;
	private JTextField tftimkiem;
	private JTable tbInfo;
	private JTextField tfTenSV;
	private JTextField tfMaSV;
	JScrollPane Scrl;
	
	Connection conn;
	Statement st;
	ResultSet rs;
	ResultSetMetaData rsm;
	private Object [] columnHeader = {"Mã sinh viên","Tên sinh viên","Lớp ","Năm sinh","Quê quán","Giới Tính", "Email", "Số điện thoại", "Ngành học"};
	DefaultTableModel model = new DefaultTableModel(columnHeader, 0);
	private JTextField tfNamsinh;
	private JTextField tfQueQuan2;
	private JTextField tfEmail;
	private JTextField tfSDT;
	private JTextField tfClass;
	private JTextField tfNganh;
	public void connectDB(){
		try {
			Class.forName("com.mysql.jdbc.Driver");
			conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/qlsv", "root", "");
		}
		catch (Exception ex) {
			System.out.println(ex.getMessage());
		}
	}
	
	
	// AUTO LAM MOI DATA 
	public void refreshData() {
		try {
			//Clear man hinh
			model.setRowCount(0);
			st = conn.createStatement();
			rs = st.executeQuery("SELECT * FROM sinhvien");
			rsm = rs.getMetaData();
			while(rs.next()){							
				String IDSV = rs.getString(1);
			    String TenSV = rs.getString(2);
			    String Class = 	rs.getString(3);
			    String NamSinh = rs.getString(4);		
			    String QueQuan = rs.getString(5);
			    String Gioitinh = rs.getString(6);
			    String Email = rs.getString(7);
			    String Sdt = rs.getString(8);
			    String Nganh = rs.getString(9);
			    Object[] rowData = new Object[] { IDSV, TenSV , Class, NamSinh ,QueQuan, Gioitinh, Email, Sdt, Nganh};
			    
			    model.addRow(rowData);						
			}			
		
			tbInfo.setModel(model);
			conn.close();
			rs.close();
			
			
		}
		
		catch(Exception ex) {
			
		}
	}
	// END - AUTO LAM MOI DATA 
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
					thongtin frame = new thongtin();
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
	public thongtin() {
		setIconImage(Toolkit.getDefaultToolkit().getImage("D:\\Icon_QLSV\\Frame\\customer-service.png"));
		setTitle("Quản lý sinh viên - HungThinh0710_K17_IT2_2017  - Beta_v1.0");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 1006, 757);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(4, 0, 0, 0));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblQunLSinh = new JLabel("QU\u1EA2N L\u00DD SINH VI\u00CAN");
		lblQunLSinh.setIcon(null);
		lblQunLSinh.setForeground(Color.BLACK);
		lblQunLSinh.setFont(new Font("Tahoma", Font.PLAIN, 49));
		lblQunLSinh.setBounds(271, 23, 468, 60);
		contentPane.add(lblQunLSinh);
		
		JButton btnAll = new JButton("Tải dữ liệu");
		btnAll.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\005-refresh.png"));
		btnAll.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				connectDB();
				try {
					//Clear man hinh
					model.setRowCount(0);
					st = conn.createStatement();
					rs = st.executeQuery("SELECT * FROM sinhvien");
					rsm = rs.getMetaData();
					while(rs.next()){							
						
						String IDSV = rs.getString(1);
					    String TenSV = rs.getString(2);
					    String Class = 	rs.getString(3);
					    String NamSinh = rs.getString(4);		
					    String QueQuan = rs.getString(5);
					    String Gioitinh = rs.getString(6);
					    String Email = rs.getString(7);
					    String Sdt = rs.getString(8);
					    String Nganh = rs.getString(9);
					    Object[] rowData = new Object[] { IDSV, TenSV , Class, NamSinh ,QueQuan, Gioitinh, Email, Sdt, Nganh};
					    
					    model.addRow(rowData);							
					}			
				
					tbInfo.setModel(model);
					conn.close();
					rs.close();
					
					
				}
				
				catch(Exception ex) {
					
				}
				
				
				
				
			}
		});
		btnAll.setBounds(773, 115, 124, 31);
		contentPane.add(btnAll);
		
		tftimkiem = new JTextField();
		tftimkiem.setBounds(238, 419, 279, 22);
		contentPane.add(tftimkiem);
		tftimkiem.setColumns(10);
		
		JButton btnTimkiem = new JButton("Tìm kiếm theo tên");
		btnTimkiem.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\001-worker.png"));
		btnTimkiem.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				connectDB();
				try {
					model.setRowCount(0);
					st = conn.createStatement();
					rs = st.executeQuery("SELECT * FROM sinhvien where tensv like '%"+tftimkiem.getText()+"%'");
					rsm = rs.getMetaData();
					while(rs.next()){							
						String IDSV = rs.getString(1);
					    String TenSV = rs.getString(2);
					    String NamSinh = rs.getString(3);		
					    String QueQuan = rs.getString(4);
					    String Gioitinh = rs.getString(5);
					    String Email = rs.getString(6);
					    String Sdt = rs.getString(7);
					    String Nganh = rs.getString(8);
					    Object[] rowData = new Object[] { IDSV, TenSV ,NamSinh ,QueQuan, Gioitinh, Email, Sdt,Nganh};
					    model.addRow(rowData);
					}
					
				}
				catch(Exception ex) {
					
				}
				
			}
		});
		btnTimkiem.setBounds(558, 412, 165, 31);
		contentPane.add(btnTimkiem);
		
		JButton btnTaomoi = new JButton("T\u1EA1o m\u1EDBi");
		btnTaomoi.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\004-people.png"));
		btnTaomoi.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				themmoi obj = new themmoi();
				obj.setVisible(true);

			}
		});
		btnTaomoi.setBounds(773, 156, 124, 31);
		contentPane.add(btnTaomoi);
		
		JButton btnChinhsua = new JButton("Cập nhật");
		btnChinhsua.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\003-transfer.png"));
		btnChinhsua.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
	
			
				try {
					connectDB();
					st = conn.createStatement();
					
					/*String gioitinh = "";
					if(rdbtnNam.isSelected()) {
						gioitinh = rdbtnNam.getText();
					}
					if(rdbtnNu.isSelected()) {
						gioitinh = rdbtnNu.getText();
					}
					*/
					int i = st.executeUpdate("Update sinhvien SET tensv = '"+tfTenSV.getText()+"', namsinh = '"+tfNamsinh.getText()+"', quequan = '"+tfQueQuan2.getText()+"',email = '"+tfEmail.getText()+"',sdt = '"+tfSDT.getText()+"', nganhhoc = '"+tfNganh.getText()+"' WHERE idSinhvien = '"+tfMaSV.getText()+"'");					
					if(i>0) {
						JOptionPane.showMessageDialog(null, "chỉnh sửa thành công");
						
						
						// LAM MOI DATA SAU KHI UPDATE
						
						refreshData();
					}
					else JOptionPane.showMessageDialog(btnChinhsua, "Chỉnh sửa thất bại !", "Lỗi !!", JOptionPane.ERROR_MESSAGE);
				}
				catch(Exception ex) {
					System.out.println(ex.getMessage());

				}
				
				
				
				
				
			}
		});
		btnChinhsua.setBounds(773, 197, 124, 31);
		contentPane.add(btnChinhsua);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(26, 454, 937, 228);
		contentPane.add(scrollPane);
		
		tbInfo = new JTable();
		scrollPane.setViewportView(tbInfo);
		tbInfo.addMouseListener(new MouseListener() {
			
			
			@Override
			public void mouseReleased(MouseEvent e) {
				
			}
			
			@Override
			public void mousePressed(MouseEvent e) {
				
			}
			
			@Override
			public void mouseExited(MouseEvent e) {
				
			}
			
			@Override
			public void mouseEntered(MouseEvent e) {
				
			}
			
			@Override
			public void mouseClicked(MouseEvent e) {
				JTable tbInfo = (JTable) e.getSource();
				int row = tbInfo.getSelectedRow();
				String maSV = (String)tbInfo.getValueAt(row,0);
				String tenSV = (String)tbInfo.getValueAt(row,1);
				String Class = (String)tbInfo.getValueAt(row, 2);
				String namsinh = (String)tbInfo.getValueAt(row,3);
				String quequan = (String)tbInfo.getValueAt(row,4);
				String email = (String)tbInfo.getValueAt(row, 6);
				String sdt = (String)tbInfo.getValueAt(row, 7);
				String nganh = (String)tbInfo.getValueAt(row, 8);
				tfMaSV.setText(maSV);
				tfTenSV.setText(tenSV);
				tfClass.setText(Class);
				tfNamsinh.setText(namsinh);
				tfQueQuan2.setText(quequan);
				tfEmail.setText(email);
				tfSDT.setText(sdt);
				tfNganh.setText(nganh);
			}
		});
		
		
		
		
		
		
		JLabel lblTensv = new JLabel("T\u00EAn sinh vi\u00EAn");
		lblTensv.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\004-id-card.png"));
		lblTensv.setBounds(72, 158, 108, 21);
		contentPane.add(lblTensv);
		
		tfTenSV = new JTextField();
		tfTenSV.setBounds(192, 155, 183, 22);
		contentPane.add(tfTenSV);
		tfTenSV.setColumns(10);
		
		JLabel lblMaSV = new JLabel("M\u00E3 sinh vi\u00EAn");
		lblMaSV.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\003-id-card-1.png"));
		lblMaSV.setBounds(72, 108, 108, 28);
		contentPane.add(lblMaSV);
		
		tfMaSV = new JTextField();
		tfMaSV.setColumns(10);
		tfMaSV.setBounds(192, 111, 183, 22);
		contentPane.add(tfMaSV);
		
		JButton btnXoa = new JButton("X\u00F3a");
		btnXoa.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\002-x-button.png"));
		btnXoa.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					connectDB();
					st = conn.createStatement();
					JOptionPane.showConfirmDialog(null, "Bạn có muốn xóa "+tfMaSV.getText());
					int i = st.executeUpdate("Delete from sinhvien where idSinhvien = '"+tfMaSV.getText()+"'");
					if(i>0) {
						JOptionPane.showMessageDialog(null, "Xóa thành công");
					
						
						// LAM MOI DATA SAU KHI XOA
						refreshData();
					}
					
					else JOptionPane.showMessageDialog(btnXoa, "Xóa thất bại !", "Lỗi !!", JOptionPane.ERROR_MESSAGE);

				} catch (SQLException ex) {
				}
				
				
				
				
				
				
			}
		});
		btnXoa.setBounds(773, 241, 124, 29);
		contentPane.add(btnXoa);
		
		JLabel lblnamsinh2 = new JLabel("Năm sinh");
		lblnamsinh2.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\002-seventeen.png"));
		lblnamsinh2.setBounds(430, 151, 112, 26);
		contentPane.add(lblnamsinh2);
		
		tfNamsinh = new JTextField();
		tfNamsinh.setColumns(10);
		tfNamsinh.setBounds(550, 153, 183, 22);
		contentPane.add(tfNamsinh);
		
		JLabel lblQuequan2 = new JLabel("Quê Quán");
		lblQuequan2.setIcon(new ImageIcon("D:\\Icon_QLSV\\Title\\png\\001-cityscape.png"));
		lblQuequan2.setBounds(72, 201, 112, 23);
		contentPane.add(lblQuequan2);
		
		tfQueQuan2 = new JTextField();
		tfQueQuan2.setColumns(10);
		tfQueQuan2.setBounds(192, 201, 183, 22);
		contentPane.add(tfQueQuan2);
		
		JProgressBar progressBar = new JProgressBar();
		progressBar.setToolTipText("");
		progressBar.setBackground(Color.GRAY);
		progressBar.setBounds(0, 397, 988, 9);
		contentPane.add(progressBar);
		
		tfEmail = new JTextField();
		tfEmail.setColumns(10);
		tfEmail.setBounds(550, 198, 183, 22);
		contentPane.add(tfEmail);
		
		JLabel lblEmail = new JLabel("Email");
		lblEmail.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\email.png"));
		lblEmail.setBounds(430, 197, 112, 23);
		contentPane.add(lblEmail);
		
		tfSDT = new JTextField();
		tfSDT.setColumns(10);
		tfSDT.setBounds(192, 248, 183, 22);
		contentPane.add(tfSDT);
		
		JLabel lblSDT = new JLabel("Số điện thoại");
		lblSDT.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\smartphone.png"));
		lblSDT.setBounds(72, 247, 112, 23);
		contentPane.add(lblSDT);
		
		tfClass = new JTextField();
		tfClass.setColumns(10);
		tfClass.setBounds(550, 110, 183, 22);
		contentPane.add(tfClass);
		
		JLabel lblLblclass = new JLabel("Lớp");
		lblLblclass.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\teacher-desk.png"));
		lblLblclass.setBounds(430, 108, 112, 26);
		contentPane.add(lblLblclass);
		
		JButton btnClear = new JButton("Clear");
		btnClear.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				
				try {
					tfMaSV.setText("");
					tfTenSV.setText("");
					tfClass.setText("");
					tfNamsinh.setText("");
					tfQueQuan2.setText("");
					tfEmail.setText("");
					tfSDT.setText("");
					tfNganh.setText("");
				}
				catch(Exception ex) {
					
				}
				
			}
		});
		btnClear.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\delete.png"));
		btnClear.setBounds(773, 282, 124, 31);
		contentPane.add(btnClear);
		
		JLabel lblNganh = new JLabel("Ngành học");
		lblNganh.setIcon(new ImageIcon("D:\\Icon_QLSV\\my-icons-collection32x32\\png\\gadget.png"));
		lblNganh.setBounds(430, 247, 112, 23);
		contentPane.add(lblNganh);
		
		tfNganh = new JTextField();
		tfNganh.setBounds(549, 244, 184, 22);
		contentPane.add(tfNganh);
		tfNganh.setColumns(10);
	}
}

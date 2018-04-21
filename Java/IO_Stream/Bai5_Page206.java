package Bai5_p206;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JTextArea;
import javax.swing.JMenuBar;
import javax.swing.JMenu;
import javax.swing.JMenuItem;
import javax.swing.JOptionPane;

import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.awt.event.ActionEvent;
import javax.swing.JScrollPane;

public class bai6 extends JFrame {

	private JPanel contentPane;
	private JFileChooser fc;
	private FileReader fr;
	private FileWriter fw;
	private BufferedReader br;
	JTextArea taData;
	private String path_temp = null;
	private String path = null;
	/**	
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					bai6 frame = new bai6();
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
	public bai6() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		
		JMenuBar menuBar = new JMenuBar();
		setJMenuBar(menuBar);
		
		JMenu mnFile = new JMenu("File");
		menuBar.add(mnFile);
		
		JMenuItem mntmNew = new JMenuItem("New");
		mntmNew.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				taData.setText("");
			}
		});
		mnFile.add(mntmNew);
		
		JMenuItem mntmSaveAs = new JMenuItem("Save As");
		mntmSaveAs.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//Save Ass file
				try {
					fc = new JFileChooser(); //Cấp phát bộ nhớ cho JFile Chooser
					fc.setDialogTitle("Save as..."); // Đặt tiêu đề cho Dialog
					File f = new File("E:\\"); // Chỉ đường dẫn ổ E gán vào biến f
					fc.setCurrentDirectory(f); //Chỉ đường dẫn mà hộp thoại Save as sẽ bắt đầu ở root nào.
					int retrieve = fc.showSaveDialog(null); // hiển thị hộp thoại Save as và gán biến trả về vào retrieve 
					if(retrieve == JFileChooser.APPROVE_OPTION) { //kiểm tra biến retrieve sẽ trả về kiểu nào
						String path = fc.getSelectedFile().getAbsolutePath(); // gán đường dẫn mà file đã chọn vào fc. rồi chuyển về "path"
						fr = new FileReader(path); // Cấp phát bộ nhớ cho FileReader
						br = new BufferedReader(fr); //
						String data = taData.getText(); //Lấy dữ liệu từ textArea gán vào chuỗi "data"
						fw = new FileWriter(path); //FileWriter sẽ đọc file từ đường dẫn "path"
						fw.write(data); //Viết dữ liệu trong chuỗi "data".
						fw.flush();
					}
				} catch (Exception e) {
					// TODO: handle exception
				}
				finally {
					try {
						fw.close();
						br.close();
					} catch (Exception e2) {
						// TODO: handle exception
					}
				}
				
				
			}
		});
		mnFile.add(mntmSaveAs);
		
		JMenuItem mntmSave = new JMenuItem("Save");
		mntmSave.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				//SAVE
				try {
					fw = new FileWriter(path);
					String data = taData.getText();
					fw.write(data);
					fw.flush();
				} catch (Exception e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
				finally {
					try {
						fw.close();
					} catch (Exception e2) {
						// TODO: handle exception
					}
				}
			}
		});
		mnFile.add(mntmSave);
		
		JMenuItem mntmOpen = new JMenuItem("Open");
		mntmOpen.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				//Open na`
				 //New Open File
				try {
					fc = new JFileChooser();
					fc.setDialogTitle("Open File");
					File f = new File("E:\\");
					fc.setCurrentDirectory(f);
					int retrieve = fc.showOpenDialog(null);
					if(retrieve == JFileChooser.APPROVE_OPTION) {
						path = fc.getSelectedFile().getAbsolutePath();
						fr = new FileReader(path);
						br = new BufferedReader(fr);
						String s = null; //Tạo một chuỗi String;
						while((s = br.readLine()) != null) {
							taData.append(s+"\n"); //nối chuỗi
						}
					}
				}
				catch (Exception e) {
					// TODO: handle exception
				}
				finally {
					try {
						fr.close();
						br.close();
						fw.close();
					} catch (Exception e2) {
						// TODO: handle exception
					}
				
					
				}
			}
		});
		mnFile.add(mntmOpen);
		
		JMenu mnEdit = new JMenu("Edit");
		menuBar.add(mnEdit);
		
		JMenuItem mntmCut = new JMenuItem("Cut");
		mntmCut.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				//CUT
				taData.cut();
			}
		});
		mnEdit.add(mntmCut);
		
		JMenuItem mntmCopy = new JMenuItem("Copy");
		mntmCopy.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				taData.copy();
			}
		});
		mnEdit.add(mntmCopy);
		
		JMenuItem mntmPaste = new JMenuItem("Paste");
		mntmPaste.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				taData.paste();
			}
		});
		mnEdit.add(mntmPaste);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(66, 54, 301, 130);
		contentPane.add(scrollPane);
		
		taData = new JTextArea();
		scrollPane.setViewportView(taData);
	}
}

		//**
		//
		//			CÁCH DÙNG JRADIO trong Java
		// 										**//
		
	
	//B1: Đầu tiên phải edit lại radio button lên thành biến toàn cục
	//==> Nhớ sửa lại 
		JRadioButton rdo1 = new JRadioButton("Name_JRadio");
		JRadioButton rdo2 = new JRadioButton("Name_JRadio");

	//		THÀNH
		rdo1 = new JRadioButton("Name_JRadio");
		rdo2 = new JRadioButton("Name_JRadio");

	//		Rồi đưa thành biến toàn cục như sau
	private JRadioButton rdo1;
	private JRadioButton rdo2;
	
	/*Sau đó tạo một biến btGT (nhóm 2 cái JRadioButton lại để tick được từng cái)
		Nhớ là tạo trên mấy cái phần info như size,font,...
	*/
	
	//CÚ PHÁP:
	ButtonGroup btGT = new ButtonGroup();

	/*
				//DEMO//
		rdo1 = new JRadioButton("S\u1EEFa");
		rdo1.setFont(new Font("Tahoma", Font.PLAIN, 17));
		rdo1.setBounds(188, 372, 56, 25);
		rdo1.add(rdo1);
		
		rdo2 = new JRadioButton("Kh\u00F4ng s\u1EEFa");
		rdo2.setFont(new Font("Tahoma", Font.PLAIN, 17));
		rdo2.setBounds(279, 372, 127, 25);
		contentPane.add(rdo2);
				//END-DEMO//
	*/
	//Rồi tạo 2 biến bt.GT đã từng khai báo cấp phát bộ nhớ trong button Group và đặt nó ở dưới phần DEMO
		btGT.add(rdo1);
		btGT.add(rdo2);
	
	/*CÁCH để nhận kiểu biến String qua database khi nhấn submit....
	- Trong phần ActionPerform của button(NÚT) 
	dùng những đoạn code sau
	*/
	//START CODE TRONG ACTIONPERFORM
	String check_rdo = "";
				// KIEM TRA RADIO NAO DUC CHON ( IsSelected )
				if(rdo1.isSelected()) {
					check_rdo = rdo1.getText();
				}
				if(rdo2.isSelected()) {
					check_rdo = rdo2.getText();
				}
	//END-START CODE TRONG ACTIONPERFORM
	/* PHÂN TÍCH CODE TRÊN...
	--	String check_rdo = "";
		==>	khai báo biến kiểu String để trả về.
	-- if(rdo1.isSelected()){
					check_rdo = rdo1.getText();
		}	
		==> Nếu "rdo1" được chọn --> Thì sẽ trả về kiểu String == tên của JRadioButton1
	-- if(rdo2.isSelected()){
					check_rdo = rdo2.getText();
		}
		==> Nếu "rdo2" được chọn --> Thì sẽ trả về kiểu String == tên của JRadioButton2
	*/

	
	
	
	//DEMO TOÀN BỘ CODE JAVA VỀ JRADIOBUTTON


import javax.swing.JRadioButton;
import javax.swing.ButtonGroup;


public class AddCoffe extends JFrame {

	private JRadioButton rdo1;
	private JRadioButton rdo2;

	
		ButtonGroup btGT = new ButtonGroup();

		
		rdo1 = new JRadioButton("JRadio số 1");
		rdo1.setFont(new Font("Tahoma", Font.PLAIN, 17));
		rdo1.setBounds(188, 372, 56, 25);
		contentPane.add(rdo1);
		
		rdo2 = new JRadioButton("JRadio số 2");
		rdo2.setFont(new Font("Tahoma", Font.PLAIN, 17));
		rdo2.setBounds(279, 372, 127, 25);
		contentPane.add(rdo2);

		btGT.add(rdo1);
		btGT.add(rdo2);
		JButton btnButtonSubmit = new JButton("Button Submit");
		btnThemmoi.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				String check_rdo = "";
				// KIEM TRA RADIO NAO DUC CHON ( IsSelected )
				if(rdo1.isSelected()) {
					check_rdo = rdo1.getText();
				}
				if(rdo2.isSelected()) {
					check_rdo = rdo2.getText();
				}
				
			}
		});
		
	}
}

	
	
	
	
	
import java.rmi.RemoteException;
import java.rmi.server.UnicastRemoteObject;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import javax.rmi.CORBA.StubDelegate;

public class atm extends UnicastRemoteObject implements atmITF{
	private Connection conn;
	private Statement st;
	private ResultSet rs;
	private ResultSetMetaData rsm;
	private int money;
	private int myID;
	private int getmoney;
	private int sodu;
	private int CLID;
	public atm() throws RemoteException {
		super();
		this.money = 0;
		this.myID = 0;
		this.getmoney = 0;
	}
	public void connectDB() {
		try {
			Class.forName("com.microsoft.sqlserver.jdbc.SQLServerDriver");
			conn = DriverManager.getConnection("jdbc:sqlserver://DESKTOP-DK94P82\\SQLEXPRESS;databaseName=qlatm;integratedSecurity=true");
			if (conn != null) {
			 System.out.println("\n Connected SQL Server \n ");
			}			
		} 
		catch (Exception e) {
		System.out.println("Can't connect to SQL Server");
		e.printStackTrace();
		}
	}
	public int checkmyID() { //Check ID de truy van
		try {
			connectDB();
			//Get du lieu trong database
	    	st = conn.createStatement();
			rs = st.executeQuery("SELECT ID FROM accountht");
			rsm = rs.getMetaData();
	    	while (rs.next()) {
	    	    this.CLID = rs.getInt("ID");
	    	}
		} catch (Exception e) {
			// TODO: handle exception
		}
		return CLID;
	}
	public int checkmymoney() { // Check tien de truy van
		try {
			connectDB();
			//Get du lieu trong database
	    	st = conn.createStatement();
			rs = st.executeQuery("SELECT money FROM accountht");
			rsm = rs.getMetaData();
	    	while (rs.next()) {
	    	    this.sodu = rs.getInt("money");
	    	}
		} catch (Exception e) {
			// TODO: handle exception
		}
		return sodu;
	}

	public int naptien(int inputmoney) {
		connectDB();
		try {
			//Get du lieu trong database
	    	st = conn.createStatement();
			rs = st.executeQuery("SELECT ID,money FROM accountht");
			rsm = rs.getMetaData();
	    	while (rs.next()) {
	    	    this.myID = rs.getInt("ID");
	    	    this.getmoney = rs.getInt("money");
	    	    this.money = (getmoney + inputmoney);
	    	    
	    	    getsetATM setatm = new getsetATM();
	    	    setatm.setMymoney(this.money);
	    	    
	    	    System.out.println("SERVER: ID"+myID + " da nap vao:   " + (inputmoney)+"VND");
	    	}
	    	//Nap tien vao database
		      int i = st.executeUpdate("Update accountht SET money = '"+money+"' WHERE ID = '"+myID+"'");
	    	  if (i > 0 ) System.out.print("Add "+money+" VND success to account ID = "+myID);
	    	  else System.out.print("FAILED function_(naptien)_");
		} catch (Exception e) {
			e.printStackTrace();
		}
		return this.money;
	}
	
	public int ruttien(int outputmoney) {
		connectDB();
		try {
			//Get du lieu trong database
	    	st = conn.createStatement();
			rs = st.executeQuery("SELECT ID,money FROM accountht WHERE ID = 1");
	    	while (rs.next()) {
	    	   this.myID = rs.getInt("ID");
	    	   this.getmoney = rs.getInt("money");
	    	   this.money = (getmoney - outputmoney);
	    	    
	    	    getsetATM setatm = new getsetATM();
	    	    setatm.setMymoney(this.money);
	    	    
	    	    System.out.println("SERVER: ID"+myID + " da rut tien:   " + (money)+"VND");
	    	}
	    	//Nap tien vao database
		      int i = st.executeUpdate("Update accountht SET money = '"+money+"' WHERE ID = '"+myID+"'");
	    	  if (i > 0 ) System.out.print("Withdraw "+money+" VND success to account ID = "+myID);
	    	  else System.out.print("FAILED function_(ruttien)_");
		} catch (Exception e) {
			e.printStackTrace();
		}
		return this.money;
	}
	
	

}
